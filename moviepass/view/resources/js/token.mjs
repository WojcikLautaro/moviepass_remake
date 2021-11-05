import * as Cookie from "./app/cookie.mjs";

export function get() {
    return (Cookie.get("token")) ? Cookie.get("token") : null;
}

export function set(token, remember) {
    Cookie.set("token", token, ((!remember) ? null : 365));
}