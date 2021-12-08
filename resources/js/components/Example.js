import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter} from "react-router-dom";
import Router from './router/Router';

function Example() {
    return (

        <div>
        <a href="/profile"> Profile</a>
        <BrowserRouter>
           <Router></Router>
        </BrowserRouter>
        </div>
    );
}

export default Example;

if (document.getElementById('indexPage')) {
    ReactDOM.render(<Example />, document.getElementById('indexPage'));
}
