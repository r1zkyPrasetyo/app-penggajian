<?php

namespace Tests\Unit;

use Tests\TestCase;

class PegawaiControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_get_data_pegawai()
    {
        $this->get('/api/pegawai')->assertStatus(200);

    }

    public function test_post_data_pegawai()
    {
        $data = [
            'nama_pegawai' => 'Abu',
            'total_gaji' => '4000000',
        ];
        $this->post('/api/pegawai', $data)
            ->assertStatus(200)
            ->assertJson($data);

    }
}
