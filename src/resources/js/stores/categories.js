import { defineStore } from 'pinia'
import axios from "axios";

const API_CATEGORIES_URL = '/api/v1/categories';

export const useCategoriesStore = defineStore({
    id: 'productCategory',
    state: () => ({
        categories: null,
        errors: []
    }),

    actions: {
        fetchCategories() {
            return axios
                .get(API_CATEGORIES_URL)
                .then(resp => this.categories = resp.data.data)
                .catch(err => {
                    this.errors.push(err.message);
                    console.error(err);
                });
        }
    },
})
