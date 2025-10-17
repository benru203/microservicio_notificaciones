<?php

describe('POST /api/webhook/validar-documento', function () {

    it('responde con un mensaje de "Documento validado"', function () {
        $response = $this->postJson('/api/webhook/validar-documento');
        $response->assertStatus(200);
        $response->assertJson([
            'mensaje' => 'Documento validado'
        ]);
    });

});
