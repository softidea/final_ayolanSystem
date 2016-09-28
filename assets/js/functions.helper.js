'use strict';

function resetBehaviors(e) {
  e.stopPropagation();
  e.preventDefault();
}

function inArray(value, array) {
  return array.indexOf(value) > -1;
}

function formatFileSize(size) {
  var formatedValue, formatedUnit;

  if (size > 999999999) {
    formatedValue = (size/1000000000).toFixed(1);
    formatedUnit = 'GB';
  }
  else if (size > 999999) {
    formatedValue = (size/1000000).toFixed(1);
    formatedUnit = 'MB';
  }
  else if (size > 999) {
    formatedValue = (size/1000).toFixed(0);
    formatedUnit = 'kB';
  }
  else {
    formatedValue = size;
    formatedUnit = 'B';
  }

  return {
    value: formatedValue,
    unit: formatedUnit
  };
}
