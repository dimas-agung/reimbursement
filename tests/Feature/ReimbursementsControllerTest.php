<?php

namespace Tests\Feature;

use App\Models\Reimbursement;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ReimbursementsControllerTest extends TestCase
{
     use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
     public function testIndexPage()
     {
         $user = User::find(1);
         $reimbursement = Reimbursement::latest()->limit(1)->paginate(10);
          //masukkan session user untuk login
         $this->actingAs($user)
             ->get('reimbursement')
             ->assertStatus(200)
             ->assertSeeText($reimbursement[0]->name);
     }
     public function testCreatePage()
     {
         $user = User::find(1);
         
         $this->actingAs($user)
             ->get(route('reimbursement.create'))
             ->assertStatus(200);
     }
     public function testEditPage()
     {
         $user = User::find(1);
         $reimbursement = Reimbursement::factory()->create();
         
         $this->actingAs($user)
             ->get(route('reimbursement.edit', $reimbursement->id))
             ->assertStatus(200);
    }
    public function testStoreImg()
    {
        $user = User::find(1);
        $attachment = UploadedFile::fake()->image('avatar.jpg', 100, 100)->size(100);
        $this->actingAs($user)->post('/reimbursement', [
            "date" => date('Y-m-d'),
            "name" => "TEST DATA",
            "attachment" => $attachment,
           
            "description" => 'test',
        ])->assertRedirect("/reimbursement")
            ->assertSessionHas("success", "Data Reimbursement has been created!");
            $this->assertDatabaseHas('reimbursements', [
                'name' => "TEST DATA",
            ]);
    }
    public function testStorePdf()
    {
        $user = User::find(1);
        $attachment = UploadedFile::fake()->create('document.pdf', 200);
        $this->actingAs($user)->post('/reimbursement', [
            "date" => date('Y-m-d'),
            "name" => "TEST DATA",
            "attachment" => $attachment,
           
            "description" => 'test',
        ])->assertRedirect("/reimbursement")
            ->assertSessionHas("success", "Data Reimbursement has been created!");
            $this->assertDatabaseHas('reimbursements', [
                'name' => "TEST DATA",
            ]);
    }
    public function testUpdateReimbursement()
    {
        $user = User::find(1);
        $reimbursement = Reimbursement::factory()->create();
        
        $attachment = UploadedFile::fake()->create('document.pdf', 200);
        
        $this->actingAs($user);
        $this->put(
            route('reimbursement.update', $reimbursement->id),
            [
            "name" => "TEST DATA",
            "attachment" => $attachment,
            "description" => 'test update',
            ],
        )->assertRedirect("/reimbursement")
            ->assertSessionHas("success", "Data Reimbursement has been updated!");
    }
    public function testDeleteReimbursement()
    {
        $user = User::find(1);
        $reimbursement = Reimbursement::factory()->create();
        $this->actingAs($user);
        $this->delete(route('reimbursement.destroy', $reimbursement->id))
            ->assertRedirect("/reimbursement")
            ->assertSessionHas("success", "Data Reimbursement has been deleted!");
        $this->assertEmpty(Reimbursement::find($reimbursement->id));
    }
    public function testApprovedReimbursement()
    {
        $user = User::find(1);
        $reimbursement = Reimbursement::factory()->create();
        $this->actingAs($user);
        $this->post(route('reimbursement.approved', $reimbursement->id))
            ->assertRedirect("/reimbursement")
            ->assertSessionHas("success", "Data Reimbursement has been approved!");
        $this->assertDatabaseHas('reimbursements', [
                'name' => $reimbursement->name,
                'status' => Reimbursement::APPROVE
        ]);
        
    }
    public function testRejectedReimbursement()
    {
        $user = User::find(1);
        $reimbursement = Reimbursement::factory()->create();
        $this->actingAs($user);
        $this->post(route('reimbursement.rejected', $reimbursement->id))
            ->assertRedirect("/reimbursement")
            ->assertSessionHas("success", "Data Reimbursement has been rejected!");
        $this->assertDatabaseHas('reimbursements', [
                            'name' => $reimbursement->name,
                            'status' => Reimbursement::REJECT
        ]);
    }
}