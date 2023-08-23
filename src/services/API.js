const apiBaseURL = (process.env.VUE_APP_URL || 'https://api.dex.proelean.com') +"/api";
// const csrfToken = document.head.querySelector('meta[name="csrf-token"]');
const TOKEN = localStorage.getItem('PROELEAN_TOKEN') || null;
const DEVICE_ID = localStorage.getItem('DEVICE_ID') || getRandomString(32);

class API {
  async request(
    route,
    payload = null,
    method = "GET",
    contentType = "application/json"
  ) {
    let options = {
      method: method,
      headers: {
        "Accept": 'application/json',
        "Authorization": `Bearer ${TOKEN}`,
        "Device-Id": DEVICE_ID,
        "Device-Type": 'web'
      },
    };

    if (contentType == 'application/json') {
      options.headers['Content-Type'] = contentType;
    }

    //payload will be sent as form data if content type is multipart/form-data
    if (options.method !== "GET") {
      if (contentType.toLowerCase() == "multipart/form-data") {
        options.body = convertToFormData(payload);
      } else if (payload && typeof payload === "object") {
        options.body = JSON.stringify(payload);
      }
    } else if (payload) {
      // payload will be appended to the url  if method is GET
      route = this.appendParams(route, payload);
    }

    try {
      let response = await fetch(this.url(route), options);
      return { status: response.status, ...(await response.json()) };
    } catch (error) {
      console.log(error);
      throw error;
    }
  }

  async get(route, payload = null) {
    return await this.request(route, payload, "GET");
  }

  async post(route, payload = null) {
    return await this.request(route, payload, "POST");
  }

  async put(route, payload = null) {
    return await this.request(route, payload, "PUT");
  }

  async delete(route, payload = null) {
    return await this.request(route, payload, "DELETE");
  }

  async patch(route, payload = null) {
    return await this.request(route, payload, "PATCH");
  }

  async upload(route, payload = null) {
    return await this.request(route, payload, "POST", "multipart/form-data");
  }

  async formData(route, payload = null) {
    return await this.request(route, payload, "POST", "multipart/form-data");
  }

  appendParams(route, payload) {
    let url = new URL(this.url(route));
    let params = new URLSearchParams(url.search.slice(1));

    if (payload && typeof payload === "object") {
      for (let key in payload) {
        params.append(key, payload[key]);
      }
    }
    route = route.split("?")[0] + "?" + params.toString();
    return route;
  }

  url(route) {
    return `${apiBaseURL}${apiBaseURL && apiBaseURL.slice(apiBaseURL.length - 1) == "/" ? "" : "/"
      }${route}`;
  }
}

function getRandomString(length) {
  var randomChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
  var result = '';
  for (var i = 0; i < length; i++) {
    result += randomChars.charAt(Math.floor(Math.random() * randomChars.length));
  }
  localStorage.setItem('DEVICE_ID', result)
  return result;
}


function convertToFormData(payload) {
  const formData = new FormData();
  for (const key in payload) {
    if (Array.isArray(payload[key])) {
      for (let i = 0; i < payload[key].length; i++) {
        formData.append(key + "[]", payload[key][i]);
      }
    }
    else
      formData.append(key, payload[key]);
  }
  return formData;
}

export default new API();
