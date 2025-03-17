<script setup>
import MainLayout from '@/layouts/MainLayout.vue';
import { Breadcrumb, BreadcrumbItem, BreadcrumbLink, BreadcrumbList, BreadcrumbPage, BreadcrumbSeparator } from '@/components/ui/breadcrumb';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { ref } from 'vue';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';

defineOptions({
    layout: MainLayout,
});

const breadcrumbs = [
    {
        title: 'Requerimento de Vista Processo',
        href: '/requerimento-vista-processo',
    },
];

const pictureFile = ref(null);

const handleFileChange = (event) => {
    try {
        const files = event.target.files;
        pictureFile.value = files.length > 0 ? files[0] : null;
    } catch (error) {
        console.error('Error handling file change:', error);
    }
};

const uploadImage = async () => {
    if (!pictureFile.value) return;

    const formData = new FormData();
    formData.append('file', pictureFile.value);

    try {
        const response = await fetch('https://neopad.site/webhook/ef3cb934-bc55-4998-bc27-98690bfc00c2', {
            method: 'POST',
            body: formData,

        });


    } catch (error) {
        console.error('Erro:', error);
    }
};
</script>

<template>
    <div class="">
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

        <div class="grid grid-cols-2 gap-4 mt-8">

            <div>
                <h1 class="text-2xl font-bold mt-4">Requerimento de Vista Processo</h1>
                <span class="text-sm text-gray-500">Para solicitar a vista de um processo, preencha o formulário.</span>

            </div>
            <div class="flex items-center justify-center">
                <Card class="w-full shadow-none">
                    <CardHeader>

                    </CardHeader>
                    <CardContent>
                        <div>
                            <p class="text-lg font-bold">Dados pessoais do requerente</p>
                            <div class="grid w-full items-center gap-1.5 mt-4 ">
                                <form class="space-y-4">
                                    <div>
                                        <Label for="name">Nome</Label>
                                        <Input id="name" type="text" placeholder="Digite seu nome completo" />
                                    </div>

                                    <div>
                                        <Label for="cpf">CPF</Label>
                                        <Input id="cpf" type="text" placeholder="Digite seu CPF" />
                                    </div>

                                    <div>
                                        <Label for="email">Email</Label>
                                        <Input id="email" type="email" placeholder="Digite seu email" />
                                    </div>

                                    <div>
                                        <Label for="phone">Telefone</Label>
                                        <Input id="phone" type="tel" placeholder="Digite seu telefone" />
                                    </div>
                                </form>
                            </div>

                        </div>
                        <p class="text-lg font-bold mt-4">Endereço</p>
                        <div class="grid w-full items-center gap-1.5 mt-4 ">
                            <form class="space-y-4">
                                <div>
                                    <Label for="cep">CEP</Label>
                                    <Input id="cep" type="text" placeholder="Digite o CEP" />
                                </div>

                                <div>
                                    <Label for="street">Rua</Label>
                                    <Input id="street" type="text" placeholder="Digite o nome da rua" />
                                </div>

                                <div>
                                    <Label for="number">Número</Label>
                                    <Input id="number" type="text" placeholder="Digite o número" />
                                </div>

                                <div>
                                    <Label for="complement">Complemento</Label>
                                    <Input id="complement" type="text" placeholder="Digite o complemento" />
                                </div>

                                <div>
                                    <Label for="cpf">CPF</Label>
                                    <Input id="cpf" type="text" placeholder="Digite seu CPF" />
                                </div>

                                <div>
                                    <Label for="email">Email</Label>
                                    <Input id="email" type="email" placeholder="Digite seu email" />
                                </div>

                                <div>
                                    <Label for="phone">Telefone</Label>
                                    <Input id="phone" type="tel" placeholder="Digite seu telefone" />
                                </div>
                            </form>
                        </div>

                    </CardContent>
                    <CardFooter>
                        Card Footer
                    </CardFooter>
                </Card>

            </div>
        </div>
    </div>
</template>
