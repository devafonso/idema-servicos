<script setup>
import { Breadcrumb, BreadcrumbItem, BreadcrumbLink, BreadcrumbList, BreadcrumbSeparator } from '@/components/ui/breadcrumb';
import { Card, CardContent, CardFooter, CardHeader } from '@/components/ui/card';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';  
import MainLayout from '@/layouts/MainLayout.vue';

defineOptions({
    layout: MainLayout,
});

const breadcrumbs = [
    {
        title: 'Licenças Emitidas',
        href: '/licencas-emitidas',
    },
];
</script>

<template>
    <div class="h-screen">
        <Breadcrumb>
            <BreadcrumbList>
                <BreadcrumbItem>
                    <BreadcrumbLink href="/home">Serviços</BreadcrumbLink>
                </BreadcrumbItem>
                <BreadcrumbSeparator />
                <BreadcrumbItem>
                    <BreadcrumbLink href="/licencas-emitidas">Licenças Emitidas</BreadcrumbLink>
                </BreadcrumbItem>
            </BreadcrumbList>
        </Breadcrumb>      

        <div class="flex mt-4">
        <!-- Lateral esquerda para filtros -->
        <aside class="w-1/4 p-4 bg-white rounded-lg">
           <div class="flex flex-col gap-4">
            <h2 class="text-lg font-bold">Filtros</h2>
            <div class="grid w-full max-w-sm items-center gap-1.5">
                <Label for="email">Tipo da Licença</Label>
                <Input id="email" type="text" placeholder="Digite o tipo da licença" />
            </div>
            <div class="items-top flex space-x-2">
    <Checkbox id="terms1" />
    <label
      for="terms2"
      class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
    >
      Accept terms and conditions
    </label>
  </div>
            <div class="grid w-full max-w-sm items-center gap-1.5">
                <Label for="email">Subdivisão de atividade</Label>
                <Input id="email" type="text" placeholder="Digite o tipo da licença" />
            </div>
            <div class="grid w-full max-w-sm items-center gap-1.5">
                <Label for="email">Tipo da Licença</Label>
                <Input id="email" type="text" placeholder="Digite o tipo da licença" />
            </div>
            <div class="grid w-full max-w-sm items-center gap-1.5">
                <Label for="email">Tipo da Licença</Label>
                <Input id="email" type="text" placeholder="Digite o tipo da licença" />
            </div>
            
           </div>
            
        </aside>

        <!-- Área principal para exibir as licenças -->
        <main class="flex-1 p-4">
            <h1 class="text-2xl font-bold">Licenças Disponíveis</h1>
            <div class="grid grid-cols-2 gap-4 mt-4">
                <!-- Exemplo de item de licença -->
                <div class="border p-4">
                    <h2 class="font-bold">LOONEY TUNES Wile E. Coyote</h2>
                    <p>Preço: £9.00</p>
                    <p>Classificação: 4.8 (21 Reviews)</p>
                </div>
                <div class="border p-4">
                    <h2 class="font-bold">Calvin Klein Jeans Mono Logo Embroidered</h2>
                    <p>Preço: £20.00</p>
                    <p>Classificação: 4.6 (15 Reviews)</p>
                </div>
                <!-- Adicione mais itens conforme necessário -->
            </div>
        </main>
    </div>

       
    </div>
</template>
