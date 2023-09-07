<?php

namespace Tests\Feature;

use App\Models\User;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class EmployeeControllerTest extends TestCase
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
        $employee = User::latest()->limit(1)->paginate(10);
         //masukkan session user untuk login
        $this->actingAs($user)
            ->get('/employee')
            ->assertStatus(200)
            ->assertSeeText($employee[0]->name);
    }
    public function testCreatePage()
    {
        $user = User::find(1);
        
        $this->actingAs($user)
            ->get(route('employee.create'))
            ->assertStatus(200);
    }
    public function testEditPage()
    {
        $user = User::find(1);
        $employee = User::factory()->create();
        
        $this->actingAs($user)
            ->get(route('employee.edit', $employee->id))
            ->assertStatus(200);
   }

   public function testUpdateEmployee()
   {
       $user = User::find(1);
       $employee = User::factory()->create();
       
       $this->actingAs($user);
       $this->put(
           route('employee.update', $employee->id),
           [
            'name' => 'DONA',
            'nip' => '123634',
            'email' => 'dona@email',
            'jabatan' => 'STAFF',
            'password' => Hash::make('123456'),
           ],
       )->assertRedirect("/employee")
           ->assertSessionHas("success", "Data Employee has been updated!");
   }
   public function testDeleteEmployee()
   {
       $user = User::find(1);
       $employee = User::factory()->create();
       $this->actingAs($user);
       $this->delete(route('employee.destroy', $employee->id))
           ->assertRedirect("/employee")
           ->assertSessionHas("success", "Data Employee has been deleted!");
       $this->assertEmpty(User::find($employee->id));
   }

}