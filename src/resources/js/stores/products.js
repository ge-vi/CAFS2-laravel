import { defineStore } from 'pinia'
import axios, {AxiosError} from "axios";

const API_PROD_URL = '/api/v1/product';

export const useCategoriesStore = defineStore({
    id: 'products',
    state: () => ({
        products: null,
        errors: []
    }),

    actions: {
        save() {
            axios
                .post(
                    API_PROD_URL,
                    product
                )
                .then(
                    resp => {
                        if (resp.status === 201) {
                            // open new product page
                            router.push({name: 'product.display', params: {product: resp.data.id}})
                        }
                    }
                )
                .catch(
                    err => {
                        if (err instanceof AxiosError) {
                            errors.value.push(err.response.data.message);
                        }
                        console.error(err)
                    }
                )
        }
    },
})
