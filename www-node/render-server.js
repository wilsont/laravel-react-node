require('dotenv').load();

console.log("starting react-render");

  const express = require('express');
  const bodyParser = require('body-parser');
  const _ = require('lodash');
  const ReactDOMServer = require('react-dom/server');

  const app = express();
  app.use(bodyParser.json({ limit: '5mb' }));

  app.use('/:componentName', (req, res) => {
    try {
      res.status(200).send(renderReact(req.params.componentName, req.body));
    } catch (err) {
      res.status(500).send(err.message);
    }
  });
  app.listen(process.env.REACT_RENDER_SERVER_PORT);

  // hack area
  if (typeof global !== 'undefined') {
    global.window = global;
  }

  // the request is a express request object
  // todo: change to use global instead of using window
  function renderReact(componentName, request) {
    console.log("componentName" + componentName);

    //use resources when local, but a symlink to the real js when in server
    const componentsPath = '../public/js/components.js';
    require(componentsPath);

    const reactComponent = _.get(window, componentName);
    return ReactDOMServer.renderToString(React.createElement(reactComponent, request.props));
  }