/**Api local Host */
export const defaulToken = document.querySelector('meta[name="csrf-token"]');
//export const BaseUrl =  "https://glovalltv.tv";
//export const BaseUrl =  "http://192.168.100.124:8010";
export const BaseUrl =  "http://13.48.1.37";
//export const BaseUrl =  "http://127.0.0.1:8000";


/*Identifiant de connection a API*/
//export const Email = "api@globalfinance-sa.net";
//export const Password = "HheW(685HJe@/dd";

//config local
export const Email = "wilson@globalfinance-sa.net";
export const Password = "@TGlobal&2023";
//export const Password = "Tjmartin.27";
export const dataAuth = {
    method: 'POST',
    headers: {
        'content-type': 'application/json',
        'Authorization': `Bearer ${defaulToken}`
    },
    body: JSON.stringify({
        "email": Email,
        "password": Password
    })
}

