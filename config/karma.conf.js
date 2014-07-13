module.exports = function(config){
  config.set({
    basePath : '../',

    files : [
      'public/lib/angular/angular.min.js',
      'public/lib/angular/angular-*.min.js',
      'public/lib/angular/angular-mocks.js',
      'public/js/**/*.js',
      'test/unit/**/*.js'
    ],

    exclude : [
      'public/lib/angular/angular-loader.min.js',
      'public/lib/angular/angular-scenario.min.js'
    ],

    autoWatch : true,

    frameworks: ['jasmine'],

    browsers : ['Chrome'],

    plugins : [
            'karma-junit-reporter',
            'karma-chrome-launcher',
            'karma-firefox-launcher',
            'karma-script-launcher',
            'karma-jasmine'
            ],

    junitReporter : {
      outputFile: 'test_out/unit.xml',
      suite: 'unit'
    }
  });
};
