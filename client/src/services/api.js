import axios from 'axios'
// import CryptoJS from 'crypto-js'

axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;

axios.defaults.headers.common = {'X-Requested-With': 'XMLHttpRequest'}

const apiClient = axios.create({    
    baseURL: "https://api.ipsbi.org",
    headers: {
        "Content-Type": "application/json",
    }, 
});

// function decryptToken(encryptedToken) {
//     const key = import.meta.env.VITE_LARAVEL_KEY;

//     var encrypted_json = JSON.parse(atob(encryptedToken));
//     const bytes = CryptoJS.AES.decrypt(encrypted_json.value, CryptoJS.enc.Base64.parse(key), {
//         iv: CryptoJS.enc.Base64.parse(encrypted_json.iv)
//     });
//     const decryptedData = bytes.toString(CryptoJS.enc.Utf8);

//     return decryptedData.split(":")[2].split('"')[1];
// }

export default apiClient;