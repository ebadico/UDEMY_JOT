<?php

namespace Tests\Feature;

use App\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
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

        $this->post('api/contacts', $this->data());

        $contact = Contact::first();

        $this->assertEquals('Test name', $contact->name);
        $this->assertEquals('email@example.com', $contact->email);
        $this->assertEquals('05/14/1988', $contact->birthday);
        $this->assertEquals('ABC String', $contact->company);

    }

    /**
     * @test
     */
    public function fields_are_required()
    {
        collect(['name', 'email', 'birthday', 'company'])
            ->each(function ($field) {
                $response = $this->post('api/contacts',
                    array_merge($this->data(), [$field => ''])
                );

                $response->assertSessionHasErrors($field);
                $this->assertCount(0, Contact::all());
            });
    }

    /**
     * @test
     */
    public function email_must_be_a_valid_email()
    {
        $response = $this->post('api/contacts',
            array_merge($this->data(), ['email' => 'NOT AN EMAIL'])
        );

        $response->assertSessionHasErrors('email');
        $this->assertCount(0, Contact::all());
    }

    /**
     * @test
     */
    public function birthdays_are_properly_stored()
    {
        $this->withoutExceptionHandling();

        $this->post('api/contacts', $this->data());

        $this->assertCount(1, Contact::all());

        $this->assertInstanceOf(Carbon::class, Contact::first()->birthday);
        $this->assertEquals('05-14-1988', Contact::first()->birthday->format('m-d-Y'));
    }

    /**
     * @test
     */
    public function a_contact_can_be_retrieved()
    {
        $this->withoutExceptionHandling();

        /**
        * @var Contact $contact
        */
        $contact = factory(Contact::class)->create();

        $response = $this->get('/api/contacts/' . $contact->id);

        $response->assertJson([
            'name' => $contact->name,
            'email' => $contact->email,
            'birthday' => $contact->birthday,
            'company' => $contact->company,
        ]);
    }

    private function data()
    {
        return [
            'name' => 'Test name',
            'email' => 'email@example.com',
            'birthday' => '05/14/1988',
            'company' => 'ABC String',
        ];
    }
}
