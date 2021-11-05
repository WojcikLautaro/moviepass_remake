function login(element, event) {
    event.preventDefault();

    var userdata = new FormData(element);
    let remember = userdata.get("remember");
    userdata.delete("remember");

    let urlSearchParams = new URLSearchParams();
    urlSearchParams.set("userdata", JSON.stringify(Object.fromEntries(userdata)));

    Element.setSpinner(element);

    var signOptions = document.getElementById('sign-options');
    signOptions.addEventListener('hidden.bs.modal', async function () {
        var token = await Request.request("POST", "account/login", urlSearchParams.toString());
        if (token) Token.set(token, remember);
        window.updateContent();
    });

    bootstrap.Modal.getInstance(signOptions).hide();
}

function logout() {
    var element = document.getElementById('sign-options');

    Element.setSpinner(element);
    element.addEventListener('hidden.bs.modal', async function () {
        await Request.request("POST", "account/logout", "token=" + Cookie.get("token"));
        Cookie.erase("token");

        Page.updateContent();
    });

    bootstrap.Modal.getInstance(element).hide();
}

async function register(element, event) {
    event.preventDefault();

    var jsonQuerry = JSON.stringify(Object.fromEntries(new FormData(element)));
    let urlSearchParams = new URLSearchParams();
    urlSearchParams.set("userdata", jsonQuerry);

    Element.setSpinner(element);

    var signOptions = document.getElementById('sign-options');
    signOptions.addEventListener('hidden.bs.modal', async function () {
        var response = await Request.request("POST", "account/register", urlSearchParams.toString());

        console.log(token);
        //Cookie.set("token", token , ((!remember) ? null : 365));

        Page.updateContent();
    });

    bootstrap.Modal.getInstance(signOptions).hide();
}

async function registerValueChecker(element) {
    if (!element.hasOwnProperty("checking")) {
        element["checking"] = true;

        let registerConfirmPassword = document.getElementById("register-confirm-password");
        let rcplcr = document.getElementById("register-confirm-password-label-cross");
        let rcplch = document.getElementById("register-confirm-password-label-check");

        let registerPassword = document.getElementById("register-password");
        let rplcr = document.getElementById("register-password-label-cross");
        let rplch = document.getElementById("register-password-label-check");

        let registerUsername = document.getElementById("register-username");
        let ruls = document.getElementById("register-username-label-spinner");
        let rulcr = document.getElementById("register-username-label-cross");
        let rulch = document.getElementById("register-username-label-check");

        function passerr(password, confirmPassword) {
            function reset() {

            }
            if (password != confirmPassword) {

                Element.show(document.getElementById("register-username-label-cross"));
                Element.show(document.getElementById("register-username-label-cross"));
            }
            else {

                Element.show(document.getElementById("register-username-label-check"));
                Element.show(document.getElementById("register-username-label-cross"));
            }
        };

        async function usnerr(username) {
            function reset() {
                Element.hide(ruls);
                Element.hide(rulcr);
                Element.hide(rulch);
            };

            if (username != "") {
                reset();

                Element.show(ruls);
                var result = await Request.request("POST", "account/checkusername", "username = " + username);
                if ("true" == result) {
                    Element.hide(ruls);
                    Element.show(rulch);
                }
                else {
                    Element.hide(ruls);
                    Element.show(rulcr);
                }
            }
        };

        {
            let doneTypingInterval = 500;

            let typingTimerRegisterConfirmPassword;
            registerConfirmPassword.addEventListener("keyup", () => {
                clearTimeout(typingTimerRegisterConfirmPassword);
                typingTimerRegisterConfirmPassword = setTimeout(() => {
                    passerr(registerPassword.value, registerConfirmPassword.value);
                }, doneTypingInterval);
            });

            let typingTimerRegisterPassword;
            registerPassword.addEventListener("keyup", () => {
                clearTimeout(typingTimerRegisterPassword);
                typingTimerRegisterPassword = setTimeout(() => {
                    passerr(registerPassword.value, registerConfirmPassword.value);
                }, doneTypingInterval);
            });

            let typingTimerRegisterUsername;
            registerUsername.addEventListener("keyup", () => {
                clearTimeout(typingTimerRegisterUsername);
                typingTimerRegisterUsername = setTimeout(() => {
                    usnerr(registerUsername.value);
                }, doneTypingInterval);
            });
        }
    }
}

export async function start() {
    console.log("sign start");
    window.login = login;
    window.register = register;
    window.registerValueChecker = registerValueChecker;
    window.logout = logout;
}
