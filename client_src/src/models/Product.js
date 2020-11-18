import axios from "axios";
const url = "http://127.0.0.1:8000/api/products";

export default class Product {
    constructor(product = {}) {
        this._id = product._id || null;
        this.title = product.title || "";
        this.category = product.category || {};
        this.price = product.price || "";
        this.rating = product.rating || 0;
        this.images = product.images || [];
        this.imageFiles = product.imageFiles || [];
    }

    static get = () => axios.get(url);

    static post(item) {
        const fd = new FormData();
        item.imageFiles.forEach(imageFile => {
            fd.append("imageFiles", imageFile);
        });
        fd.append("title", item.title);
        fd.append("category", item.category._id);
        fd.append("price", item.price);
        fd.append("rating", item.rating);

        return axios.post(url, fd);
    }

    static put(item) {
        const fd = new FormData();
        item.imageFiles.forEach(imageFile => {
            fd.append("imageFiles", imageFile);
        });
        fd.append("title", item.title);
        fd.append("category", item.category._id);
        fd.append("price", item.price);
        fd.append("rating", item.rating);

        return axios.put(`${url}/${item._id}`, fd);
    }

    static delete(_id) {
        return (
            confirm("Are you sure you want to delete this product?") &&
            axios.delete(`${url}/${_id}`)
        );
    }
}
