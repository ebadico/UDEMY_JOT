<?php

namespace Tests\Feature;

use App\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactsTest extends TestCase
{
    use RefreshDatabase;

    /**
    * @test
    */
    public function a_contact_can_be_added()
    {
        $this->withoutExceptionHandling();

        $this->post('api/contacts', [
            'name' => 'Test name',
            'email' => 'email@example.com',
            'birthday' => '05/14/1988',
            'company' => 'ABC String',
        ]);

        $contact = Contact::first();

        $this->assertEquals('Test name', $contact->name);
        $this->assertEquals('email@example.com', $contact->email);
        $this->assertEquals('05/14/1988', $contact->birthday);
        $this->assertEquals('ABC String', $contact->company);

    }

    /**
    * @test
    */
    public function a_contact_requires_a_name()
    {
        $response = $this->post('api/contacts', [
            'email' => 'email@example.com',
            'birthday' => '05/14/1988',
            'company' => 'ABC String',
        ]);

        $response->assertSessionHasErrors('name');
        $this->assertCount(0, Contact::all());
    }

    /**
    * @test
    */
    public function a_contact_requires_an_email()
    {
        $response = $this->post('api/contacts', [
            'name' => 'Test name',
            'birthday' => '05/14/1988',
            'company' => 'ABC String',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertCount(0, Contact::all());
    }
}
