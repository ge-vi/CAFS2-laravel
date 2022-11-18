import { defineStore } from 'pinia'
import axios from "axios";

const API_CATEGORIES_URL = '/api/v1/categories';

export const useCategoriesStore = defineStore('productCategory', {
    state: () => ({
        categories: null
    }),

    actions: {
        fetchCategories() {
            return axios
                .get(API_CATEGORIES_URL)
                .then(resp => this.categories = resp.data.data);
        }
    }
})
