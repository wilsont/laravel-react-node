import React from 'react';
import ReactDOM from 'react-dom';
import assign from 'lodash/assign';


window.React = React;
window.ReactDOM = ReactDOM;

window.ReactComponents = window.ReactComponents || {};

[
  require('./jsx/test.jsx'),
].forEach(v => assign(window.ReactComponents, v));
