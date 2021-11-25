import env from "../bootstrap/env";
import axios from "axios";

const Api = {
    searchUrl: env.apiSearchUrl,
};

axios.interceptors.response.use(response => {
    return response.data;
}, error => {
    const response = error.response.data;
    return Promise.reject(response);
});

Api.search = async function (data) {
    return await axios.post(this.searchUrl, {...data});
}

export default Api;
