<?php

namespace Tests\Unit;

use Tests\TestCase;

class GajiPegawaiControllerTest extends TestCase
{
     /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_get_data_gaji_pegawai()
    {
        $this->get('/api/gaji-pegawai')->assertStatus(200);

    }

    public function test_post_data_gaji_pegawai()
    {
        $data = [
            'id_pegawai'         => 'Abu',
            'tota_gaji_diterima' => '4000000',
        ];
        $this->post('/api/gaji-pegawai', $data)
            ->assertStatus(200)
            ->assertJson($data);

    }
}
