<script setup>
import { Breadcrumb, BreadcrumbItem, BreadcrumbLink, BreadcrumbList, BreadcrumbSeparator } from '@/components/ui/breadcrumb';
import { Card, CardContent } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import MainLayout from '@/layouts/MainLayout.vue';
import { ref } from 'vue';

defineOptions({
    layout: MainLayout,
});

const breadcrumbs = [
    {
        title: 'Requerimento de Vista Processo',
        href: '/requerimento-vista-processo',
    },
];

// Formulário
const etapaAtual = ref(0); // Controla a etapa do formulário
const nome = ref('');
const cpf = ref('');
const cep = ref('');
const email = ref('');
const telefone = ref('');
const rua = ref('');
const numero = ref('');
const complemento = ref('');

// Mensagens de erro
const mensagemErro = ref('');
const mensagemErro2 = ref('');

//Dados do veículo
const placa = ref('');
const modelo = ref('');
const tipo_veiculo = ref('');
const ano = ref('');
const marca = ref('');
const ocupantes = ref('');

const etapaAnterior = () => {
    if (etapaAtual.value >= 1) {
        etapaAtual.value -= 1;
    }
};

const etapaSeguinte = () => {
    if (etapaAtual.value === 0) {
        if (nome.value && cpf.value && cep.value && email.value && telefone.value) {
            etapaAtual.value = 1; // Dados pessoais avança para a segunda etapa
        } else {
            mensagemErro.value = '* Campo obrigatório';
        }

        // Validação dos campos 0
    } else if (etapaAtual.value === 1) {
        if (rua.value && numero.value && complemento.value) {
            etapaAtual.value = 2; //Endereço vança para a terceira etapa
        } else {
            mensagemErro2.value = '* Campo obrigatório';
        }
        // Validação dos campos 1
    } else if (etapaAtual.value === 2) {
        if (placa.value && modelo.value && tipo_veiculo.value && ano.value && marca.value && ocupantes.value) {
            etapaAtual.value = 3; // Daos do Veículo avança para a quarta etapa
        } else {
            mensagemErro2.value = '* Campo obrigatório';
        }
        // Validação dos campos 2
    } else if (etapaAtual.value === 3) {
        etapaAtual.value = 4; // Avança para a etapa final
    }
};

// Estado para controlar a etapa atual do formulário
// Removed duplicate declaration of etapaAtual

// Estado para exibir a mensagem de sucesso
const mensagemSucesso = ref(false);

// Função chamada ao enviar o formulário
const enviarFormulario = () => {
    // Aqui você pode adicionar a lógica real do envio, por exemplo, enviar para uma API
    // Simulando o envio com um pequeno delay
    setTimeout(() => {
        // Após "enviar" o formulário, mostramos a mensagem de sucesso
        mensagemSucesso.value = true;
    }, 1000); // Simula o tempo de envio
};
</script>

<template>
    <Breadcrumb>
        <BreadcrumbList>
            <BreadcrumbItem>
                <BreadcrumbLink href="/home">Serviços</BreadcrumbLink>
            </BreadcrumbItem>
            <BreadcrumbSeparator />
            <BreadcrumbItem>
                <BreadcrumbLink href="/requerimento-vista-processo">Requerimento de Vista Processo</BreadcrumbLink>
            </BreadcrumbItem>
        </BreadcrumbList>
    </Breadcrumb>

    <div class="container mx-auto mt-10 px-4"></div>
    <div class="h-50 items-center justify-center">
        <div class="mt-4 text-center font-bold">
            <h1 class="text-3xl">
                REGISTRO DE VISITA ÀS TRILHAS DO CAMPO DUNAR DE NÍSIA FLORESTA
                <br />
                ÁREA DE PROTEÇÃO AMBIENTAL <span class="text-green-600">BONFIM-GUARAÍRA</span>
            </h1>
            <div class="mt-2">
                <span class="text-sm text-gray-500">Para solicitar a vista de um processo, preencha o formulário.</span>
            </div>
        </div>
    </div>

    <div class="container m-10 mx-auto mt-20 max-w-xl px-4">
        <div class="flex items-center justify-center">
            <Card class="w-full shadow-none">
                <div v-if="etapaAtual !== 3" class="mb-10 flex items-center justify-center">
                    <h1 class="mt-10 text-2xl font-bold">Agenda Dunas</h1>
                </div>

                <CardContent>
                    <div>
                        <form class="space-y-4">
                            <!-- Etapa 1: Dados Pessoais -->
                            <div v-if="etapaAtual === 0">
                                <p class="text-xl font-bold text-stone-400">* Dados pessoais do requerente</p>
                                <div class="mt-10 grid w-full items-center gap-1.5">
                                    <div>
                                        <Label for="nome">Nome</Label>
                                        <Input id="nome" v-model="nome" type="text" placeholder="Digite seu nome completo" />
                                        <div class="mt-2 h-1/4 w-1/2">
                                            <span class="mt-10 rounded px-4 py-1 text-red-700" v-if="mensagemErro" id="mensagem-error">{{
                                                mensagemErro
                                            }}</span>
                                        </div>
                                    </div>
                                    <div>
                                        <Label for="cpf">CPF</Label>
                                        <Input id="cpf" v-model="cpf" type="text" placeholder="Digite seu CPF" />
                                        <div class="mt-2 h-1/4 w-1/2">
                                            <span class="mt-10 rounded px-4 py-1 text-red-700" v-if="mensagemErro" id="mensagem-error">{{
                                                mensagemErro
                                            }}</span>
                                        </div>
                                    </div>
                                    <div>
                                        <Label for="cep">CEP</Label>
                                        <Input id="cep" v-model="cep" type="text" placeholder="Digite o CEP" />
                                        <div class="mt-2 h-1/4 w-1/2">
                                            <span class="mt-10 rounded px-4 py-1 text-red-700" v-if="mensagemErro" id="mensagem-error">{{
                                                mensagemErro
                                            }}</span>
                                        </div>
                                    </div>
                                    <div>
                                        <Label for="email">Email</Label>
                                        <Input id="email" v-model="email" type="email" placeholder="Digite seu email" />
                                        <div class="mt-2 h-1/4 w-1/2">
                                            <span class="mt-10 rounded px-4 py-1 text-red-700" v-if="mensagemErro" id="mensagem-error">{{
                                                mensagemErro
                                            }}</span>
                                        </div>
                                    </div>
                                    <div>
                                        <Label for="phone">Telefone</Label>
                                        <Input id="phone" v-model="telefone" type="tel" placeholder="Digite seu telefone" />
                                        <div class="mt-2 h-1/4 w-1/2">
                                            <span class="mt-10 rounded px-4 py-1 text-red-700" v-if="mensagemErro" id="mensagem-error">{{
                                                mensagemErro
                                            }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Etapa 2: Endereço -->
                    <div v-if="etapaAtual === 1">
                        <p class="mt-10 text-xl font-bold text-stone-400">* Endereço</p>
                        <div class="mt-4 grid w-full items-center gap-1.5">
                            <div>
                                <Label for="rua">Rua</Label>
                                <Input id="rua" v-model="rua" type="text" placeholder="Digite o nome da rua" />
                                <div class="mt-2 h-1/4 w-1/2">
                                    <span class="mt-10 rounded px-4 py-1 text-red-700" v-if="mensagemErro2" id="mensagem-error">{{
                                        mensagemErro2
                                    }}</span>
                                </div>
                            </div>
                            <div>
                                <Label for="numero">Número</Label>
                                <Input id="numero" v-model="numero" type="text" placeholder="Digite o número" />
                                <div class="mt-2 h-1/4 w-1/2">
                                    <span class="mt-10 rounded px-4 py-1 text-red-700" v-if="mensagemErro2" id="mensagem-error">{{
                                        mensagemErro2
                                    }}</span>
                                </div>
                            </div>
                            <div>
                                <Label for="complemento">complemento</Label>
                                <Input id="complemento" v-model="complemento" type="text" placeholder="Digite o complemento" />
                                <div class="mt-2 h-1/4 w-1/2">
                                    <span class="mt-10 rounded px-4 py-1 text-red-700" v-if="mensagemErro2" id="mensagem-error">{{
                                        mensagemErro2
                                    }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Etapa 1: Dados do Veículo -->

                    <div v-if="etapaAtual === 2">
                        <p class="mt-10 text-xl font-bold text-stone-400">* Dados do Veículo</p>
                        <div class="mt-4 grid w-full items-center gap-1.5">
                            <div>
                                <Label for="placa">Placa ou Chassi</Label>
                                <input
                                    type="text"
                                    id="placa"
                                    v-model="placa"
                                    name="placa"
                                    class="w-full rounded-lg border px-3 py-2 text-gray-700 focus:outline-none"
                                    placeholder="Digite a placa do veículo"
                                />
                            </div>
                            <div>
                                <Label for="modelo">Modelo</Label>
                                <input
                                    type="text"
                                    id="modelo"
                                    v-model="modelo"
                                    name="modelo"
                                    class="w-full rounded-lg border px-3 py-2 text-gray-700 focus:outline-none"
                                    placeholder="Digite o modelo do veículo"
                                />
                            </div>
                            <div>
                                <Label for="cor">Tipo do Veículo</Label>
                                <div class="mt-2">
                                    <select
                                        class="w-full rounded-lg border px-3 py-2 text-gray-700 focus:outline-none"
                                        name="tipo_veiculo"
                                        id="tipo_veiculo"
                                        v-model="tipo_veiculo"
                                        autocomplete="off"
                                        onchange="muda_tp_veiculo(this.value)"
                                    >
                                        <option value="">Selecione o tipo de veículo</option>
                                        <option value="1">Veículo 4x4</option>
                                        <option value="2">Veículo 4x2</option>
                                        <option value="3">Buggy</option>
                                        <option value="4">UTV</option>
                                        <option value="8">Outros</option>
                                        <option value="5">Quadricilo</option>
                                        <option value="6">Motocicleta</option>
                                        <option value="7">Triciclo</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <Label for="cor">Ano</Label>
                                <input
                                    type="text"
                                    id="ano"
                                    v-model="ano"
                                    name="cor"
                                    class="w-full rounded-lg border px-3 py-2 text-gray-700 focus:outline-none"
                                    placeholder="Digite o ano do veículo"
                                />
                            </div>
                            <div>
                                <Label for="cor">Marca</Label>
                                <input
                                    type="text"
                                    id="marca"
                                    v-model="marca"
                                    name="marca"
                                    class="w-full rounded-lg border px-3 py-2 text-gray-700 focus:outline-none"
                                    placeholder="Digite a marca do veículo"
                                />
                            </div>
                            <div>
                                <Label for="ocupantes">Ocupantes</Label>
                                <input
                                    type="text"
                                    id="placa"
                                    v-model="ocupantes"
                                    name="ocupantes"
                                    class="w-full rounded-lg border px-3 py-2 text-gray-700 focus:outline-none"
                                    placeholder="Digite a placa do veículo"
                                />
                            </div>
                        </div>
                    </div>

                    <!-- Etapa 3: Revisão dos dados -->
                    <div v-if="etapaAtual === 3">
                        <div class="text-5 h-50 mt-5 rounded-lg bg-green-800 p-4 text-center">
                            <p class="mt-5 text-3xl font-bold text-stone-100">Revisão de registro</p>
                        </div>
                        <div class="mt-4 grid w-full items-center gap-3">
                            <p class="mt-5 text-xl font-bold text-gray-400">Dados pessoais do requerente</p>
                            <hr />
                            <div class="rounded-lg bg-stone-100 p-4">
                                <p><strong>Nome:</strong> {{ nome }}</p>
                                <p><strong>CPF:</strong> {{ cpf }}</p>
                                <p><strong>CEP:</strong> {{ cep }}</p>
                                <p><strong>Email:</strong> {{ email }}</p>
                                <p><strong>Telefone:</strong> {{ telefone }}</p>
                            </div>
                            <p class="mt-5 text-xl font-bold text-gray-400">Endereço</p>
                            <hr />
                            <div class="rounded-lg bg-stone-100 p-4">
                                <p><strong>Rua:</strong> {{ rua }}</p>
                                <p><strong>Número:</strong> {{ numero }}</p>
                                <p><strong>complemento:</strong> {{ complemento }}</p>
                            </div>
                            <p class="mt-5 text-xl font-bold text-gray-400">Dados do Veículo</p>
                            <hr />
                            <div class="rounded-lg bg-stone-100 p-4">
                                <p><strong>Placa ou Chassi:</strong> {{ placa }}</p>
                                <p><strong>Modelo:</strong> {{ modelo }}</p>
                                <p><strong>Tipo do Veículo:</strong> {{ tipo_veiculo }}</p>
                                <p><strong>Ano:</strong> {{ ano }}</p>
                                <p><strong>Marca:</strong> {{ marca }}</p>
                                <p><strong>Ocupantes:</strong> {{ ocupantes }}</p>
                            </div>
                            <hr />
                        </div>
                    </div>
                    <!-- Botões de navegação e envio -->
                    <div class="mb-5 mt-5 flex items-center justify-between">
                        <!-- Botão Voltar -->
                        <button
                            v-if="etapaAtual >= 1"
                            @click="etapaAnterior"
                            class="rounded bg-gray-500 px-4 py-2 font-bold text-white hover:bg-gray-700"
                        >
                            Voltar
                        </button>

                        <!-- Botão Próximo -->
                        <button
                            v-if="etapaAtual < 3"
                            @click="etapaSeguinte"
                            class="rounded bg-green-700 px-4 py-2 font-bold text-white hover:bg-green-900"
                        >
                            Próximo
                        </button>

                        <!-- Botão Enviar -->
                        <button
                            v-if="etapaAtual === 3"
                            @click="enviarFormulario"
                            class="rounded bg-green-700 px-4 py-2 font-bold text-white hover:bg-green-900"
                        >
                            Enviar
                        </button>
                    </div>
                </CardContent>
            </Card>
        </div>
        <div v-if="mensagemSucesso" class="mt-4 flex items-center justify-center rounded bg-[#dc2626] py-2 text-white" id="mensagem-sucesso">
            <span>Formulário enviado!</span>
            <img src="/public/" alt="">
        </div>
    </div>
</template>
