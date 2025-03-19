<script setup>
import { Breadcrumb, BreadcrumbItem, BreadcrumbLink, BreadcrumbList, BreadcrumbSeparator } from '@/components/ui/breadcrumb';
import { Card, CardContent } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import MainLayout from '@/layouts/MainLayout.vue';
import { ref, watch } from 'vue';
// Local Directive
import { mask } from 'vue-the-mask';

defineOptions({
    layout: MainLayout,
    directives: {
        mask: mask,
    },
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
const email = ref('');
const telefone = ref('');
// Endereço e data da visita
const dataVisita = ref('');
const cep = ref('');
const rua = ref('');
const bairro = ref('');
const cidade = ref('');
const estado = ref('');
const dataVisitaFormatada = ref('');

// Mensagens de erro
const mensagemErro = ref('');
const mensagemErro2 = ref('');
const mensagemErro3 = ref('');

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
        if (nome.value && cpf.value && email.value && telefone.value) {
            etapaAtual.value = 1; // Dados pessoais avança para a segunda etapa
        } else {
            mensagemErro.value = '* Campo obrigatório';
        }

        // Validação dos campos 0
    } else if (etapaAtual.value === 1) {
        if (cep.value && dataVisita.value) {
            etapaAtual.value = 2; //Endereço vança para a terceira etapa
        } else {
            mensagemErro2.value = '* Campo obrigatório';
        }
        // Validação dos campos 1
    } else if (etapaAtual.value === 2) {
        if (placa.value && modelo.value && tipo_veiculo.value && ano.value && marca.value && ocupantes.value) {
            etapaAtual.value = 3; // Daos do Veículo avança para a quarta etapa
        } else {
            mensagemErro3.value = '* Campo obrigatório';
        }
        // Validação dos campos 2
    } else if (etapaAtual.value === 3) {
        etapaAtual.value = 4; // Avança para a etapa final
    }
};

const mensagemSucesso = ref(false);

// Função chamada ao enviar o formulário
const enviarFormulario = () => {
    // Simula o envio do formulário
    setTimeout(() => {
        mensagemSucesso.value = true;
    }, 1000);
};

// esconder a mensagem de sucesso
const fecharMensagemSucesso = () => {
    mensagemSucesso.value = false;
    console.console.log('fecharMensagemSucesso');
};

const formatarData = (data) => {
    if (data) {
        const [ano, mes, dia] = data.split('-');
        return `${dia}/${mes}/${ano}`;
    }
    return '';
};

watch(dataVisita, (novaData) => {
    dataVisitaFormatada.value = formatarData(novaData);
});

// Consulta o CEP na API ViaCEP TESTE

const endereco = ref([]); // Ref para armazenar os dados do endereço
const erro = ref(false); // Ref para verificar se houve erro na consulta

// Função para consultar o CEP via API do ViaCEP
const consultarCep = async () => {
    erro.value = false; // Resetando erro

    // Verificar se o CEP tem 8 caracteres (ex: 12345678)
    if (cep.value.length === 8) {
        try {
            const response = await fetch(`https://viacep.com.br/ws/${cep.value}/json/`);
            const data = await response.json();

            // Se a consulta retornar sucesso, preenche o endereço
            if (!data.erro) {
                endereco.value = {
                    rua: data.logradouro,
                    bairro: data.bairro,
                    cidade: data.localidade,
                    estado: data.uf,
                };
            } else {
                endereco.value = null;
                erro.value = true;
            }
        } catch (error) {
            erro.value = true;
            endereco.value = null;
        }
    } else {
        erro.value = true;
        endereco.value = null;
    }
};

function formatCardNumber(input) {
    const value = input.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
    const formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
    input.value = formattedValue;
}
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
                REGISTRO DE VISITA ÀS TRILHAS DO CAMPO DUNAR DE <br />
                <span class="text-green-600">NÍSIA FLORESTA</span>
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
                                        <Label for="nome" class="">Nome</Label>
                                        <Input id="nome" v-model="nome" type="text" placeholder="Digite seu nome completo" />
                                        <div class="mt-2 h-1/4 w-1/2">
                                            <span class="mt-10 rounded px-4 py-1 text-red-700" v-if="!nome && mensagemErro" id="mensagem-error">{{
                                                mensagemErro
                                            }}</span>
                                        </div>
                                    </div>
                                    <div>
                                        <Label for="cpf">CPF</Label>
                                        <Input id="cpf" v-model="cpf" v-mask="'###.###.###-##'" type="text" placeholder="Digite seu CPF" />
                                        <div class="mt-2 h-1/4 w-1/2">
                                            <span class="mt-10 rounded px-4 py-1 text-red-700" v-if="!cpf && mensagemErro" id="mensagem-error">{{
                                                mensagemErro
                                            }}</span>
                                        </div>
                                    </div>
                                    <div>
                                        <Label for="email">Email</Label>
                                        <Input id="email" v-model="email" type="email" placeholder="Digite seu email" />
                                        <div class="mt-2 h-1/4 w-1/2">
                                            <span class="mt-10 rounded px-4 py-1 text-red-700" v-if="!email && mensagemErro" id="mensagem-error">{{
                                                mensagemErro
                                            }}</span>
                                        </div>
                                    </div>
                                    <div>
                                        <Label for="telefone">Telefone</Label>
                                        <Input
                                            id="telefone"
                                            v-mask="'(##) #####-####'"
                                            v-model="telefone"
                                            type="tel"
                                            placeholder="Digite seu telefone"
                                        />
                                        <div class="mt-2 h-1/4 w-1/2">
                                            <span class="mt-10 rounded px-4 py-1 text-red-700" v-if="!telefone && mensagemErro" id="mensagem-error">{{
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
                                <Label for="rua">Digite o CEP</Label>
                                <Input id="cep" v-model="cep" @blur="consultarCep" type="text" placeholder="Digite o nome da rua" />
                                <div class="mt-2 h-1/4 w-1/2">
                                    <span class="mt-10 rounded px-4 py-1 text-red-700" v-if="!cep && mensagemErro2" id="mensagem-error">{{
                                        mensagemErro2
                                    }}</span>
                                </div>
                            </div>
                            <div>
                                <Label for="rua">Rua</Label>
                                <Input id="rua" v-model="endereco.rua" disabled type="text" placeholder="Digite o nome da rua" />
                            </div>
                            <div>
                                <Label for="bairro">Bairro</Label>
                                <Input id="bairro" v-model="endereco.bairro" disabled type="text" placeholder="Digite o número" />
                            </div>
                            <div>
                                <Label for="cidade">cidade</Label>
                                <Input id="cidade" v-model="endereco.cidade" disabled type="text" placeholder="Digite o cidade" />
                            </div>
                            <div>
                                <Label for="cidade">Estado</Label>
                                <Input id="estado" v-model="endereco.estado" disabled type="text" placeholder="Digite o cidade" />
                            </div>
                        </div>
                        <p class="mb-5 mt-5 text-xl font-bold text-stone-400">* Data da visita</p>
                        <div>
                            <Label for="cidade">Data da visita</Label>
                            <Input id="cidade" v-model="dataVisita" type="date" placeholder="Digite o cidade" class="w-[160px]" />
                            <div class="mt-2 h-1/4 w-1/2">
                                <span v-if="!dataVisita && mensagemErro2" class="mt-10 rounded px-4 py-1 text-red-700" id="mensagem-error">
                                    {{ mensagemErro2 }}
                                </span>
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
                                <div class="mt-2 h-1/4 w-1/2">
                                    <span class="mt-10 rounded px-4 py-1 text-red-700" v-if="!placa && mensagemErro3" id="mensagem-error">{{
                                        mensagemErro3
                                    }}</span>
                                </div>
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
                                <div class="mt-2 h-1/4 w-1/2">
                                    <span class="mt-10 rounded px-4 py-1 text-red-700" v-if="!modelo && mensagemErro3" id="mensagem-error">{{
                                        mensagemErro3
                                    }}</span>
                                </div>
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
                                <div class="mt-2 h-1/4 w-1/2">
                                    <span class="mt-10 rounded px-4 py-1 text-red-700" v-if="!tipo_veiculo && mensagemErro3" id="mensagem-error">{{
                                        mensagemErro3
                                    }}</span>
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
                                <div class="mt-2 h-1/4 w-1/2">
                                    <span class="mt-10 rounded px-4 py-1 text-red-700" v-if="!ano && mensagemErro3" id="mensagem-error">{{
                                        mensagemErro3
                                    }}</span>
                                </div>
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
                                <div class="mt-2 h-1/4 w-1/2">
                                    <span class="mt-10 rounded px-4 py-1 text-red-700" v-if="!marca && mensagemErro3" id="mensagem-error">{{
                                        mensagemErro3
                                    }}</span>
                                </div>
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
                                <div class="mt-2 h-1/4 w-1/2">
                                    <span class="mt-10 rounded px-4 py-1 text-red-700" v-if="!ocupantes && mensagemErro3" id="mensagem-error">{{
                                        mensagemErro3
                                    }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Etapa 3: Revisão dos dados -->
                    <div v-if="etapaAtual === 3">
                        <div class="text-5 h-50 rounded-lgp-4 text-center">
                            <p class="mt-10 text-4xl font-bold text-black">Confira seus dados</p>
                        </div>
                        <div class="mt-4 grid w-full items-center gap-3">
                            <p class="mt-5 text-xl font-bold text-gray-400">Dados pessoais do requerente</p>
                            <hr />
                            <div class="rounded-lg bg-stone-100 p-4">
                                <p><strong class="mr-0.5">Nome:</strong> {{ nome }}</p>
                                <p><strong class="mr-0.5">CPF:</strong> {{ cpf }}</p>
                                <p><strong class="mr-0.5">CEP:</strong> {{ cep }}</p>
                                <p><strong class="mr-0.5">Email:</strong> {{ email }}</p>
                                <p><strong class="mr-0.5">Telefone:</strong> {{ telefone }}</p>
                            </div>
                            <p class="mt-5 text-xl font-bold text-gray-400">Endereço</p>
                            <hr />
                            <div class="rounded-lg bg-stone-100 p-4">
                                <p><strong class="mr-0.5">Rua:</strong> {{ endereco.rua }}</p>
                                <p><strong class="mr-0.5">Número:</strong> {{ endereco.bairro }}</p>
                                <p><strong class="mr-0.5">Cidade:</strong> {{ endereco.cidade }}</p>
                                <p><strong class="mr-0.5">Estado:</strong> {{ endereco.estado }}</p>
                                <p><strong class="mr-0.5">Data da visita:</strong> {{ dataVisitaFormatada }}</p>
                            </div>
                            <p class="mt-5 text-xl font-bold text-gray-400">Dados do Veículo</p>
                            <hr />
                            <div class="rounded-lg bg-stone-100 p-4">
                                <p><strong class="mr-0.5">Placa ou Chassi:</strong> {{ placa }}</p>
                                <p><strong class="mr-0.5">Modelo:</strong> {{ modelo }}</p>
                                <p><strong class="mr-0.5">Tipo do Veículo:</strong> {{ tipo_veiculo }}</p>
                                <p><strong class="mr-0.5">Ano:</strong> {{ ano }}</p>
                                <p><strong class="mr-0.5">Marca:</strong> {{ marca }}</p>
                                <p><strong class="mr-0.5">Ocupantes:</strong> {{ ocupantes }}</p>
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

        <!-- Mensagem de sucesso -->

        <div v-if="mensagemSucesso" class="fixed inset-0 z-50 flex items-center justify-center bg-[#000000d2] bg-black" id="mensagem-sucesso">
            <div class="rounded p-6 text-center">
                <div class="flex flex-col justify-between rounded-[2.25rem] border-gray-400 bg-white p-4 lg:border-gray-400">
                    <div class="mb-8">
                        <div class="mb-10 text-3xl font-bold text-gray-800">
                            Clique aqui para visualizar o<br /><span class="text-6xl text-green-600">ticket</span>
                        </div>
                        <p class="text-bold text-3xl text-gray-700">
                            <button
                                @click="fecharMensagemSucesso"
                                class="mt-4 rounded bg-gray-200 px-6 py-2 font-bold text-gray-500 hover:bg-gray-300"
                            >
                                visualizar
                            </button>
                        </p>
                    </div>
                    <div
                        class="houver:bg-gray-300 hover:grayscale- flex items-center justify-center py-5 opacity-50 grayscale hover:opacity-100 hover:duration-500 ..."
                    >
                        <img class="w-[25%]" src="../../img/confirmacao.png" alt="Avatar of Jonathan Reinink" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
