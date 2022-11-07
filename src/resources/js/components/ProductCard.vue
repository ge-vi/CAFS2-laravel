<template>

    <div class="col">
        <div class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
                <p class="my-0 fw-bolder">{{ product.productName }}</p>
                <p>Category: {{ product.categoryName }}</p>
            </div>
            <div class="card-body">
                <p>{{ product.productDescription }}</p>
                <p>Price: {{ new Intl.NumberFormat('lt-lt', { style: 'currency', currency: 'EUR' }).format(product.productPrice) }}</p>
            </div>
            <div class="card-body">
                <p class="text-muted">is active: {{ product.productIsActive }}</p>
            </div>
            <div class="card-footer">
                <!-- {{ route('products.show', $productId) }} -->
                <a
                    href="#"
                    type="button"
                    class="w-100 btn btn-lg btn-outline-success"
                >view product details</a>
            </div>
        </div>
    </div>

</template>

<script setup>
// const productPrice = 123.456;
// console.log(new Intl.NumberFormat('lt-lt', { style: 'currency', currency: 'EUR' }).format(productPrice));

// defineProps({
//     productName: {type: String, required: true},
//     categoryName: String,
//     productDescription: String,
//     productPrice: Number,
//     productIsActive: Boolean
// })

defineProps({
    product: {
        type: Object,
        required: true
    }
})
</script>
