<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Support\Facades\Log;



class TicketTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_can_user_delete_another_unowned_ticket()
    {
        $ticketOwner = User::factory()->create([
            'role' => 'user',
        ]);

        $anotherUser = User::factory()->create([
            'role' => 'user',
        ]);

        $ticket = Ticket::create([
            'created_by' => $ticketOwner->id,
            'title' => 'Feature Test',
            'description' => 'Feature Test',
            'status' => 'pending',
            'priority' => 'low',
            'assigned_to' => $ticketOwner->id,
        ]);

        $response = $this->actingAs($anotherUser)->delete(route('ticket.destroy', $ticket));

        
        $response->assertRedirect();

        // Comprueba el mensaje de error en la sesión
        $response->assertSessionHas(
            'error',
            'This ticket is assigned or it is not resolved.'
        );

        // El ticket debe seguir existiendo
        $this->assertDatabaseHas('tickets', [
            'id' => $ticket->id,
        ]);
    }

    public function test_normal_user_cannot_update_ticket()
    {
        $user = User::factory()->create([
            'role' => 'user',
        ]);

        $ticket = Ticket::create([
            'created_by' => $user->id,
            'title' => 'Feature Test',
            'description' => 'Feature Test',
            'status' => 'pending',
            'priority' => 'low',
            'assigned_to' => null,
        ]);

        $response = $this->actingAs($user)->put(
            route('ticket.update', $ticket),
            [
                'title' => 'Updated title',
                'description' => 'Updated description',
                'status' => 'resolved',
                'priority' => 'high',
                'assigned_to' => $user->id,
            ]
        );

        // Los campos protegidos no deben modificarse
        $this->assertDatabaseHas('tickets', [
            'id' => $ticket->id,
            'status' => 'pending',
            'priority' => 'low',
            'assigned_to' => null,
        ]);
    }

    public function test_user_cannot_view_another_ticket()
    {
        $user = User::factory()->create([
            'role' => 'user',
        ]);
        $anotherUser = User::factory()->create([
            'role' => 'user',
        ]);

        $ticket = Ticket::create([
            'created_by' => $user->id,
            'title' => 'Feature Test',
            'description' => 'Original description',
            'status' => 'pending',
            'priority' => 'low',
            'assigned_to' => null,
        ]);

        $response = $this->actingAs($anotherUser)
            ->get(route('ticket.show', $ticket));

        // Se espera que el acceso sea denegado
        $response->assertRedirect();
    }

    public function test_admin_can_operate_over_tickets()
    {
        $user = User::factory()->create([
            'role' => 'user',
        ]);
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $ticket = Ticket::create([
            'created_by' => $user->id,
            'title' => 'Feature Test',
            'description' => 'Original description',
            'status' => 'pending',
            'priority' => 'low',
            'assigned_to' => null,
        ]);

        $response = $this->actingAs($admin)
            ->get(route('ticket.show', $ticket));

        // Se espera que el acceso permitido
        $response->assertOk();
    }

    public function test_user_can_delete_his_own_ticket_pending_not_assigned()
    {
        $user = User::factory()->create([
            'role' => 'user',
        ]);

        $ticket = Ticket::create([
            'created_by' => $user->id,
            'title' => 'Feature Test',
            'description' => 'Feature Test',
            'status' => 'pending',
            'priority' => 'low',
            'assigned_to' => null,
        ]);
        $response = $this->actingAs($user)
        ->delete(route('ticket.destroy', $ticket));
        
        $response->assertRedirect();
    }

    public function test_user_cannot_delete_own_ticket_not_pending_assigned()
    {
        $user = User::factory()->create([
            'role' => 'user',
        ]);

        $otherUser = User::factory()->create([
            'role' => 'user',
        ]);

        $ticket = Ticket::create([
            'created_by' => $user->id,
            'title' => 'Feature Test',
            'description' => 'Feature Test',
            'status' => 'resolved',
            'priority' => 'medium',
            'assigned_to' => $otherUser->id,
        ]);

        // Elimina el Ticket
        $response = $this->actingAs($user)
            ->delete(route('ticket.destroy', $ticket));
        
        $response->assertSessionHas(
            'error',
            'This ticket is assigned or it is not resolved.'
        );
    }
    
}
