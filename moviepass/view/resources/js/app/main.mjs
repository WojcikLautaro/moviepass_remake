import "../bootstrap 5.0.2/bootstrap.bundle.min.js";

//Load React.
//Note: when deploying, replace "development.js" with "production.min.js".
import "https://unpkg.com/react@17/umd/react.development.js";
import "https://unpkg.com/react-dom@17/umd/react-dom.development.js";

class Request {
  static async httpRequest(method, url, { headers, body, options } = {}) {
      class HttpResponse {
          constructor(xhr) {
              this.body = xhr.response;
              this.status = xhr.status;
              this.headers = xhr.getAllResponseHeaders();
          }

          toString() {
              return this.body;
          }
      }

      class HttpError {
          constructor(xhr) {
              this.body = xhr.response;
              this.status = xhr.status;
              this.headers = xhr.getAllResponseHeaders();
          }

          toString() {
              let json = JSON.parse(this.body);
              return "[" + this.status + "] Error: " + json.error || json.errors.join(", ");
          }
      }

      method = method.toUpperCase();

      var xhr = new XMLHttpRequest();
      xhr.open(method, url, true);

      var promise = new Promise((resolve, reject) => {
          xhr.onload = function () {
              if (this.status >= 200 && this.status < 300 && this.readyState == 4)
                  resolve(new HttpResponse(xhr));
          }

          xhr.onerror = function () {
              reject(new HttpError(xhr));
          }

          xhr.onabort = function () {
              reject(new HttpError(xhr));
          }
      });

      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      for (let key in headers) {
          if (Object.hasOwnProperty.call(headers, key)) {
              xhr.setRequestHeader(key, headers[key])
          }
      }

      if (options && options.hasOwnProperty("checkProgress")) {
          xhr.upload.onprogress = options.checkProgress
      }

      xhr.send(body);

      return promise;
  }

  static async request(method, url, querry) {
      let response = await Request.httpRequest(method, url, {
          body: querry
      });

      return response.toString();
  }
}

class Cookie {
  static set(name, value, days = "") {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
  }

  static get(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
  }

  static erase(name) {
    document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
  }

  static documentHasCookies() {
    return (!document.cookie) ? false : true;
  }
}

class Token {
  static get() {
      return (Cookie.get("token")) ? Cookie.get("token") : null;
  }

  static set(token, remember) {
      Cookie.set("token", token, ((!remember) ? null : 365));
  }
}

class Element {
  static hide(element) {
      element.classList.add("fade");
  }

  static show(element) {
      element.classList.remove("fade");
  }

  static fade(element) {
      Element.hide(element);
      element.addEventListener("transitionend", () => {
          element.remove();
      })
  }

  static fromFormData(formData) {
      var object = {};
      formData.forEach((value, key) => {
          // Reflect.has in favor of: object.hasOwnProperty(key)
          if (!Reflect.has(object, key)) {
              object[key] = value;
              return;
          }
          if (!Array.isArray(object[key])) {
              object[key] = [object[key]];
          }
          object[key].push(value);
      });

      return object;
  }
}

class React_ {
  static cookieWarning() {
    const e = React.createElement;

    class CookieWarning extends React.Component {
      constructor(props) {
        super(props);
        this.state = { accepted: false };
      }

      render() {
        if (this.state.accepted) { return null; }

        return e( 'button', { onClick: () => {
            Cookie.set("cookie-consent", "true", 365),
            this.setState({ accepted: true }) ,
          'Accept'
          }});
      }
    }

    const domContainer = document.querySelector('#cookie_warning_container');
    ReactDOM.render(e(CookieWarning), domContainer);
  }
}

class PageContent {
  static setSpinner(element) {
      element.innerHTML = '<div class="d-flex justify-content-center"><div class="spinner-border text-primary" role="status"> <span class="visually-hidden"> Loading...</span></div></div>';
  }

  static async setWithRequest(element, url, querry = {}) {
      PageContent.setSpinner(element);
      element.innerHTML = await Request.request('POST', url, querry);
  }

  static async callRenderedInMain(link, querry = {}) {
        await PageContent.setWithRequest(document.getElementById("main"), link, querry);
    }

  static async updateContent(token) {
        var prom = PageContent.callRenderedInMain("home/default", "token=" + token);
        await PageContent.setWithRequest(document.getElementById("navbar"), "account", "token=" + token);
        await prom;
    }
}

document.addEventListener("DOMContentLoaded", async () => {
    await PageContent.updateContent(Token.get());
    //await import("../sign.mjs").then(module => module.start());

    window.updateContent = PageContent.updateContent;
    //window.test = Movie.test;

    if (Cookie.get("cookie-consent") != "true")
      React_.cookieWarning();

    Element.fade(document.getElementById("loading-screen"));
});
