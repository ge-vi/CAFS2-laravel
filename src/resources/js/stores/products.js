import {defineStore} from 'pinia'
import axios from "axios";

const API_PROD_URL = '/api/v1/product';

/*
https://pinia.vuejs.org/core-concepts/#option-stores
You can think of state as the data of the store,
getters as the computed properties of the store,
and actions as the methods.
*/

export const useProductsStore = defineStore('product', {
    state: () => ({
        product: {}
    }),

    actions: {
        initProduct() {

            console.info('empty product initialized');

            this.product = {
                name: null,
                description: null,
                category: null,
                price: null,
                stock: null,
                identifier: null,
                is_active: 1
            }
        },
        saveNew() {
            return axios
                .post(
                    API_PROD_URL,
                    this.product
                )
                .then(
                    resp => {
                        if (resp.status === 201) {
                            // console.dir(resp);
                            // this.product.id = resp.data.data.id;
                            Object.assign(this.product, resp.data.data);
                        }
                    }
                )
        },
        load() {
            return axios
                .get(`${API_PROD_URL}/${this.product.id}`)
                .then(resp => {
                    Object.assign(this.product, resp.data.data);
                    // product.value = resp.data.data;
                });
        },
        update() {
            return axios
                .patch(
                    `${API_PROD_URL}/${this.product.id}`,
                    {
                        id:             this.product.id,
                        is_active:      this.product.isActive,
                        category_id:    this.product.category['id'],
                        stock:          this.product.stock,
                        name:           this.product.name,
                        description:    this.product.description,
                        identifier:     this.product.identifier,
                        price:          this.product.price
                    }
                );
        },
        delete() {
            return axios
                .delete(`${API_PROD_URL}/${this.product.id}`);
        }
    }
})
