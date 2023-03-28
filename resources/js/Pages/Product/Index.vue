<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import AlertSuccess from '@/Components/AlertSuccess.vue';
import DeleteProduct from '@/Pages/Product/Partials/DeleteProduct.vue';
import ViewProduct from '@/Pages/Product/Partials/ViewProduct.vue';

defineProps({
    products: {
        type: Array,
    },
    status: {
        type: String,
    },
    canEdit: {
        type: Boolean,
    },
    canDelete: {
        type: Boolean,
    },
});


</script>

<template>
    <Head title="Products List" />

    
    
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Products</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <AlertSuccess v-if="status">{{ status }}</AlertSuccess>
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 float-right" v-if="canDelete">
                        <Link :href="route('product.create')"> 
                            <PrimaryButton>Add New</PrimaryButton>
                        </Link>
                    </div>
                    <div class="p-6 text-gray-900">List Of All Products With Inventory</div>
                    <div class="p-6">
                        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                                <table class="min-w-full leading-normal">
                                    <thead>
                                        <tr>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                Product
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                SKU
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                Quantity
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="product in products" :key="product.id">
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm w-2/5">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 w-10 h-10 hidden sm:table-cell">
                                                        <img class="w-full h-full rounded-full"
                                                            :src="product.image"
                                                            :alt="product.name" />
                                                    </div>
                                                    <div class="ml-3">
                                                        <p class="text-gray-900 whitespace-no-wrap">
                                                            {{ product.name }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap text-center">{{product.sku}}</p>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap text-center">
                                                    {{product.quantity}}
                                                </p>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm w-2/5">
                                                <div class="flex items-center float-right">
                                                    <div class="mr-3">
                                                        <ViewProduct :product="product"></ViewProduct>
                                                    </div>
                                                    <div class="mr-3" v-if="canEdit">
                                                        <Link :href="route('product.edit', product.id)">
                                                            <SecondaryButton>Edit</SecondaryButton>
                                                        </Link>
                                                    </div>
                                                    <div class="mr-3" v-if="canDelete">
                                                        <DeleteProduct :id="product.id"></DeleteProduct>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
