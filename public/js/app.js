import { initializeDataTable } from './datatable.js';
import { bindEventHandlers } from './events.js';

$(document).ready(function() {
    initializeDataTable();
    bindEventHandlers();
});