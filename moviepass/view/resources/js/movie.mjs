import * as Token from "./token.mjs";
import * as Element from "./app/element.mjs";
import * as Request from "./app/request.mjs";

export async function test(element, event) {
    event.preventDefault();

    let urlSearchParams = new URLSearchParams();
    urlSearchParams.set("token", Token.get());
    urlSearchParams.set("searchData", JSON.stringify(Element.fromFormData(new FormData(element))));

    var bb = await Request.request('POST', "api/list", urlSearchParams.toString());
    console.log(urlSearchParams.toString() , bb);
}
