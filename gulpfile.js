/**
 * Gulp tasks
 *
 * @copyright Copyright (c) 2016, hugw.io
 * @author Hugo W - me@hugw.io
 * @license GPLv2
 */

// Enable ES6 -> ES5 transformation (Babel)
// when loading gulp tasks
require('babel-core/register')

// Load tasks and configs
require('./assets/tasks.js')
