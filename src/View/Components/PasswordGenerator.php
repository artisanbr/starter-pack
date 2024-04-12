<?php
/*
 * Copyright (c) 2024.  Todos os Direitos Reservados - Artisan Digital
 * Desenvolvido por Renalcio Carlos Jr. aos cuidados de artisan.dev.br
 */

namespace ArtisanBR\StarterPack\View\Components;

use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class PasswordGenerator extends Component
{
    public function __construct(
        public string $label = 'Gerar Senha',

        public ?string $target = 'password',

        public ?string $icon = 'eos.password',

        public bool $hasConfirmation = false,

        public int $length = 8,

        public bool $letters = true,

        public bool $numbers = true,

        public bool $symbols = true,

        public bool $spaces = false,
    ) {
        Debugbar::debug($this->hasConfirmation);
    }

    public function generatePassword(): string
    {

        return Str::password(length: $this->length, letters: $this->letters, numbers: $this->numbers, symbols: $this->symbols, spaces: $this->spaces);
    }

    public function render(): string
    {
        return <<<'blade'
@script
<script>
    Alpine.data('passwordGenerator', () => {
        return {
            generate() {
                console.log('Gerando senha');
                let length = {{ Js::from($length) }};
                let letters = {{ Js::from($letters) }};
                let numbers = {{ Js::from($numbers) }};
                let symbols = {{ Js::from($symbols) }};
                let hasConfirmation = {{ Js::from($hasConfirmation) }};
                let charset = '';
                let password = '';
                let wireTarget = {{ Js::from($target) }};

                if (letters) {
                    charset += 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                }
                if (numbers) {
                    charset += '0123456789';
                }
                if (symbols) {
                    charset += '!@#$%^&*()_+-=[]{}|;:,.<>?';
                }

                for (let i = 0; i < length; i++) {
                    let randomChar = charset.charAt(Math.floor(Math.random() * charset.length));
                    password += randomChar;
                }
                console.log(`Password gerado: ${password} sera aplicado em ${wireTarget}`);

                $wire.$set(wireTarget, password);

                if(hasConfirmation){
                    $wire.$set(`${wireTarget}_confirmation`, password);
                }

            },
        }
    })
</script>
@endscript
<div x-data="passwordGenerator">
<x-button {{ $attributes }} :icon="$icon" :label="$label" @click="generate"/>
</div>
blade;
    }
}
