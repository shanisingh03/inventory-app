<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';


const props = defineProps({
    product: {
        type: Object,
    },
});

const confirmingUserDeletion = ref(false);

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;
};

const closeModal = () => {
    confirmingUserDeletion.value = false;
};
</script>

<template>
        <PrimaryButton @click="confirmUserDeletion">View</PrimaryButton>

        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    Product Detail
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    Product Name : {{ product.name }}
                </p>
                <p class="mt-1 text-sm text-gray-600">
                    Product SKU : {{ product.sku }}
                </p>
                <p class="mt-1 text-sm text-gray-600">
                    Product Quantity : {{ product.quantity }}
                </p>
                <img :src="product.image" :alt="product.name" />

                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal"> Close </SecondaryButton>
                </div>
            </div>
        </Modal>
</template>
