<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    product: {
        type: Object,
    },
});

const form = useForm({
    name: props.product.name,
    sku: props.product.sku,
    quantity: props.product.quantity,
});

// const form = useForm({
//     name: "",
//     sku: "",
//     quantity: "",
// });
</script>

<template>
    <Head title="Edit Product" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Product</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 float-right">
                        <Link :href="route('products.list')">
                            <PrimaryButton>Back</PrimaryButton>
                        </Link>
                    </div>
                    <!-- <div class="p-6 text-gray-900">List Of All Products With Inventory</div> -->
                    <div class="p-6">
                        <form @submit.prevent="form.post(route('product.update', product.id))" class="mt-6 space-y-6">
                            <div>
                                <InputLabel for="product_name" value="Product Name" />

                                <TextInput
                                    id="product_name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.name"
                                    required
                                    autofocus
                                    autocomplete="product_name"
                                />

                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <div>
                                <InputLabel for="sku" value="SKU" />

                                <TextInput
                                    id="sku"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.sku"
                                    required
                                    autocomplete="sku"
                                />

                                <InputError class="mt-2" :message="form.errors.sku" />
                            </div>

                            <div>
                                <InputLabel for="quantity" value="Quantity" />

                                <TextInput
                                    id="quantity"
                                    type="number"
                                    class="mt-1 block w-full"
                                    v-model="form.quantity"
                                    required
                                    autocomplete="quantity"
                                />

                                <InputError class="mt-2" :message="form.errors.quantity" />
                            </div>

                            

                            <div class="flex items-center gap-4">
                                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                                </Transition>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
