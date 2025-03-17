<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

interface Props {
    title?: string;
    description?: string;
}

defineProps<Props>();
</script>

<template>
    <div class="min-h-screen flex flex-col">
        <Head :title="title">
            <meta v-if="description" name="description" :content="description" />
        </Head>

        <!-- Header -->
        <header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <!-- Logo -->
                        <div class="flex-shrink-0">
                            <h1 class="text-xl font-bold text-gray-900 dark:text-white">I D E M A</h1>
                        </div>
                    </div>                
                   
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-grow bg-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <slot />
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-green-800 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div>
                        <h3 class="font-bold">IDEMA</h3>
                        <p>Instituto Desenvolvimento do Meio Ambiente do RN</p>
                        <div class="flex space-x-4 mt-2">
                            <a href="#" class="hover:text-gray-400">Facebook</a>
                            <a href="#" class="hover:text-gray-400">Twitter</a>
                            <a href="#" class="hover:text-gray-400">YouTube</a>
                        </div>
                    </div>
                    <div>
                        <h4 class="font-bold">Serviços</h4>
                        <ul>
                            <li><a href="#" class="hover:text-gray-400">Consultoria Ambiental</a></li>
                            <li><a href="#" class="hover:text-gray-400">Licenciamento</a></li>
                            <li><a href="#" class="hover:text-gray-400">Educação Ambiental</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-bold">Recursos</h4>
                        <ul>
                            <li><a href="#" class="hover:text-gray-400">Blog</a></li>
                            <li><a href="#" class="hover:text-gray-400">Centro de Ajuda</a></li>
                            <li><a href="#" class="hover:text-gray-400">Novidades</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-bold">Empresa</h4>
                        <ul>
                            <li><a href="#" class="hover:text-gray-400">Sobre nós</a></li>
                            <li><a href="#" class="hover:text-gray-400">Contato</a></li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-gray-700 mt-8 pt-4 text-center text-sm">
                    © {{ new Date().getFullYear() }} Instituto Desenvolvimento do Meio Ambiente do RN. Todos os direitos reservados.
                </div>
            </div>
        </footer>
    </div>
</template>

