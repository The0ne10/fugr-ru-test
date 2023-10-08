<?php

namespace Tests\Feature\Api;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Notebook;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class NotebookTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('local');
        $this->withHeaders([
            'accept' => 'application/json'
        ]);
    }

    /** @test */
    public function a_notebook_can_be_stored()
    {

        $this->withoutExceptionHandling();

        $file = File::create('my_image.jpg');

        $data = [
            'fullName' => 'Фамилия Имя Отчество',
            'company' => 'Компания',
            'phone' => '89135624308',
            'email' => 'exampled@mail.ru',
            'birthday' => '2023-05-03',
            'image' => $file
        ];

        $res = $this->post('/api/v1/notebook', $data);

        $this->assertDatabaseCount('notebooks', 1);

        $notebooks = Notebook::first();

        $this->assertEquals($data['fullName'], $notebooks->fullName);
        $this->assertEquals($data['company'], $notebooks->company);
        $this->assertEquals($data['phone'], $notebooks->phone);
        $this->assertEquals($data['email'], $notebooks->email);
        $this->assertEquals($data['birthday'], $notebooks->birthday->format('Y-m-d'));
        $this->assertEquals('images/' . $file->hashName(), $notebooks->image);

        $res->assertJson([
            'data' => [
                'id' => $notebooks->id,
                'fullName' => $notebooks->fullName,
                'company' => $notebooks->company,
                'phone' => $notebooks->phone,
                'mail' => $notebooks->email,
                'birthday' => $notebooks->birthday->format('Y-m-d'),
                'image' => $notebooks->image
            ]
        ]);
    }

    /** @test */
    public function attribute_fullName_is_required_for_storing_notebook()
    {
        $data = [
            'fullName' => '',
            'phone' => '89135624308',
            'email' => 'exampled@mail.ru',
        ];

        $res = $this->post('/api/v1/notebook', $data);

        $res->assertStatus(422);
        $res->assertInvalid('fullName');
    }

    /** @test */
    public function attribute_phone_is_required_for_storing_notebook()
    {
        $data = [
            'fullName' => 'Фамилия Имя Отчество',
            'phone' => '',
            'email' => 'exampled@mail.ru',
        ];

        $res = $this->post('/api/v1/notebook', $data);

        $res->assertStatus(422);
        $res->assertInvalid('phone');
    }

    /** @test */
    public function a_notebook_can_be_update()
    {

        $this->withoutExceptionHandling();
        $notebooks = Notebook::factory()->create();

        $file = File::create('image.jpg');

        $data = [
            'fullName' => 'Гримальд Виктор Степанович',
            'company' => 'За Императора',
            'phone' => '88005553535',
            'email' => 'forTheEmperror@mail.ru',
            'birthday' => '2023-05-02',
            'image' => $file
        ];

        $res = $this->patch('/api/v1/notebook/' . $notebooks->id, $data);

        $this->assertDatabaseCount('notebooks', 1);


        $notebooks = Notebook::first();
        $this->assertEquals($data['fullName'], $notebooks->fullName);
        $this->assertEquals($data['company'], $notebooks->company);
        $this->assertEquals($data['phone'], $notebooks->phone);
        $this->assertEquals($data['email'], $notebooks->email);
        $this->assertEquals($data['birthday'], $notebooks->birthday->format('Y-m-d'));
        $this->assertEquals('images/' . $file->hashName(), $notebooks->image);

        $res->assertJson([
            'data' => [
                'id' => $notebooks->id,
                'fullName' => $notebooks->fullName,
                'company' => $notebooks->company,
                'phone' => $notebooks->phone,
                'mail' => $notebooks->email,
                'birthday' => $notebooks->birthday->format('Y-m-d'),
                'image' => $notebooks->image
            ]
        ]);
    }

    /** @test */
    public function response_for_route_notebooks_index_list()
    {

        $this->withoutExceptionHandling();
        $notebooks = Notebook::factory(10)->create();

        $res = $this->get('/api/v1/notebook');



        $json = $notebooks->map(function ($notebook) {
            return [
                'id' => $notebook->id,
                'fullName' => $notebook->fullName,
                'company' => $notebook->company,
                'phone' => $notebook->phone,
                'mail' => $notebook->email,
                'birthday' => $notebook->birthday->format('Y-m-d'),
                'image' => $notebook->image
            ];
        })->toArray();

        $res->assertJson([
            'data' => $json
        ]);
    }

    /** @test */
    public function show_single_page_notebook()
    {

        $this->withoutExceptionHandling();
        $notebook = Notebook::factory()->create();

        $res = $this->get('/api/v1/notebook/'. $notebook->id);

        $res->assertJson([
            'data' => [
                'id' => $notebook->id,
                'fullName' => $notebook->fullName,
                'company' => $notebook->company,
                'phone' => $notebook->phone,
                'mail' => $notebook->email,
                'birthday' => $notebook->birthday->format('Y-m-d'),
                'image' => $notebook->image
            ]
        ]);
    }

    /** @test */
    public function delete_notebook()
    {
        $this->withoutExceptionHandling();
        $notebook = Notebook::factory()->create();
        $res = $this->delete('/api/v1/notebook/'. $notebook->id);

        $this->assertDatabaseCount('notebooks', 0);

        $res->assertJson([
            'message' => 'done'
        ]);
    }
}
