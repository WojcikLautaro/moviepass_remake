'use strict';

await import("../js/app/main.mjs");

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
