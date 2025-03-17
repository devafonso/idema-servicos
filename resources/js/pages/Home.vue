<script setup lang="ts">
import { ref } from 'vue';
import { Card, CardHeader, CardContent } from '@/components/ui/card';
import MainLayout from '@/layouts/MainLayout.vue';
import { Globe } from 'lucide-vue-next';

defineOptions({
    layout: MainLayout,
});

const services = ref([
    {
        title: 'Audiência Pública',
        description: 'Sistema de solicitação de Audiências Públicas.',
    },
    {
        title: 'Biblioteca Virtual - BV',
        description: 'Todos os arquivos do Idema estão concentrados agora neste repositório.',
    },
    {
        title: 'Cadastro Ambiental Rural - CAR',
        description: 'Site do Cadastro Ambiental Rural - CAR.',
    },
    {
        title: 'Carteira de Coopista',
        description: 'Carteira para Acesso ao Parque das Dunas/Bosque dos Namorados.',
    },
    {
        title: 'Documentação Exigida - Licenciamento Ambiental',
        description: 'Documentação exigida para o licenciamento ambiental (documentação técnica e não técnica).',
    },
    {
        title: 'EIA/RIMA',
        description: 'Consulta de relatórios de estudo de impacto ambiental / relatório de impacto ambiental.',
    },
    {
        title: 'Licenças Emitidas',
        description: 'Consulta de licenças emitidas pelo Idema baseado na data de emissão da licença.',
    },
    {
        title: 'GAIA',
        description: 'Sistema de licenciamento ambiental e fiscalização do IDEMA.',
    },
    {
        title: 'Licenças Requeridas',
        description: 'Consulta de licenças requeridas ao Idema baseado na data de formação da licença.',
    },
    {
        title: 'Legislação',
        description: 'Legislação relacionada ao licenciamento ambiental.',
    },
    {
        title: 'Monitoramento das Águas',
        description: 'Boletins de Balneabilidade para classificar as condições das Águas das praias do Rio Grande do Norte.',
    },
    {
        title: 'Ouvidoria e Acesso à Informação',
        description: 'Fala.BR Plataforma integrada de ouvidoria e acesso à informação.',
    },
]);
</script>

<template>
     <Head title="Serviços Ambientais" />
     
     
    <div class="py-20">
        <h1 class="text-6xl font-semibold py-2 text-center">
            Serviços Ambientais que<br>Protegem o nosso <span class="text-green-600">Ecossistema</span>
        </h1>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 py-12">        
        <Card v-for="service in services" :key="service.title" class="min-h-[200px] bg-zinc-50 shadow-none cursor-pointer">
            <CardHeader>
                <div class="flex items-center justify-center w-10 h-10 rounded bg-green-100 dark:bg-green-900/20 mb-4">
                    <Globe class="w-6 h-6 text-green-600 dark:text-green-400" />
                </div>
                <h2 class="font-semibold">{{ service.title }}</h2>
            </CardHeader>
            <CardContent>
                <p>{{ service.description }}</p>
            </CardContent>
        </Card>
    </div>
</template>

