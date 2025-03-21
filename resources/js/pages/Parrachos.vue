<script setup>
import { Breadcrumb, BreadcrumbItem, BreadcrumbLink, BreadcrumbList, BreadcrumbSeparator } from '@/components/ui/breadcrumb';
import MainLayout from '@/layouts/MainLayout.vue';

import { ref } from 'vue';

import { Alert, AlertDescription } from '@/components/ui/alert';

const dataVisita = ref('');
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

import { watch } from 'vue';
// Local Directive
import { mask } from 'vue-the-mask';

defineOptions({
    layout: MainLayout,
    directives: {
        mask: mask,
    },
});

watch(dataVisita, (novaData) => {
    dataVisitaFormatada.value = formatarData(novaData);
});
</script>
<template>
    <!-- TÍTULO -->
    <Breadcrumb>
        <BreadcrumbList>
            <BreadcrumbItem>
                <BreadcrumbLink href="/home">Serviços</BreadcrumbLink>
            </BreadcrumbItem>
            <BreadcrumbSeparator />
            <BreadcrumbItem>
                <BreadcrumbLink href="/parrachos">Parrachos</BreadcrumbLink>
            </BreadcrumbItem>
        </BreadcrumbList>
    </Breadcrumb>
    <!-- INPUTS -->
    <div class="container mx-auto mt-10 px-4">
        <div class="h-50 items-center justify-center">
            <div class="mt-4 text-center font-bold">
                <h1 class="text-3xl">
                    REGISTRO DE VISITA AO
                    <span class="text-green-600">PARRACHO PIRANGI</span>
                </h1>
                <div class="mt-2">
                    <span class="text-sm text-gray-500">Use o formulário abaixo para gerar um ticket</span>
                </div>
            </div>
        </div>

        <!-- DIV BOX CENTRAL -->
        <div class="container m-10 mx-auto mt-20 max-w-xl px-4">
            <!-- ALERTA -->

            <Alert variant="destructive" class="border-[#fff3cd] bg-[#fff3cd]">
                <AlertDescription class="text-center text-xl text-[#856404]">RESTAM 34 VAGAS PARA HOJE! </AlertDescription>
            </Alert>

            <!-- DIV BOX -->
            <div class="mt-10 flex items-center justify-center">
                <div class="w-full rounded-lg border bg-card text-card-foreground shadow-none">
                    <div class="mb-10 flex items-center justify-center">
                        <h1 class="mt-10 text-4xl font-bold">Agendar visita</h1>
                    </div>
                    <CardContent>
                        <div>
                            <div>
                                <p class="px-10 text-xl font-bold text-gray-400">* Dados do Responsável</p>
                                <div class="mt-10 grid w-full items-center gap-1.5"></div>
                            </div>
                            <div class="p-6 pt-0">
                                <div class="rounded-lg bg-stone-100 p-4">
                                    <form class="space-y-4">
                                        <div class="mt-10 grid w-full items-center gap-1.5">
                                            <div>
                                                <label
                                                    for="nome"
                                                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                                    >Nome</label
                                                ><input
                                                    class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                                                    id="nome"
                                                    type="text"
                                                    placeholder="Digite seu nome completo"
                                                />
                                            </div>
                                            <div>
                                                <label
                                                    for="cpf"
                                                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                                    >CPF</label
                                                ><input
                                                    class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                                                    id="cpf"
                                                    type="text"
                                                    placeholder="Digite seu CPF"
                                                />
                                            </div>
                                            <div>
                                                <label
                                                    for="email"
                                                    class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                                    >Email</label
                                                ><input
                                                    class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                                                    id="email"
                                                    type="email"
                                                    placeholder="Digite seu email"
                                                />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <br />
                                <!-- DADOS DA EMBARCAÇÂO -->

                                <div>
                                    <p class="px-4 text-xl font-bold text-gray-400">* Dados do Trasporte</p>
                                    <div class="mt-10 grid w-full items-center gap-1.5"></div>
                                </div>
                                <div class="rounded-lg bg-stone-100 p-4">
                                    <div class="mt-10 grid w-full items-center gap-1.5">
                                        <div>
                                            <label
                                                for="nome"
                                                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                                >Nome</label
                                            ><input
                                                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                                                id="nome"
                                                type="text"
                                                placeholder="Digite o nome do"
                                            />
                                        </div>
                                        <div>
                                            <label
                                                for="cpf"
                                                class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                                >Número</label
                                            ><input
                                                class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                                                id="cpf"
                                                type="text"
                                                placeholder="Digite o número "
                                            />
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <div>
                                    <label
                                        for="cidade"
                                        class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
                                        >Data da visita</label
                                    ><input
                                        class="flex h-10 w-[160px] rounded-md border border-input bg-background px-3 py-2 text-base ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                                        id="cidade"
                                        type="date"
                                        placeholder="Digite o cidade"
                                    />
                                    <div class="mt-2 h-1/4 w-1/2"><!--v-if--></div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-5 mt-5 flex items-center justify-center">
                            <button @click="enviarFormulario" class="rounded bg-green-700 px-4 py-2 font-bold text-white hover:bg-green-900">
                                Cadastrar
                            </button>
                        </div>
                    </CardContent>
                </div>
            </div>
        </div>
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
                        <button @click="fecharMensagemSucesso" class="mt-4 rounded bg-gray-200 px-6 py-2 font-bold text-gray-500 hover:bg-gray-300">
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
</template>
