module.exports = function ( grunt ) {
    grunt.initConfig( {
        watch: {
            files: [
                "../Controller/*.php",
                "../Entity/*.php",
                "../Form/*.php",
                "../Repository/*.php",
                "../Resource/*.php",
                "../Service/*.php",
                "../ServiceProvider/*.php",
                "../Event.php",
                "../PluginManager.php",
                "../Tests/Service/*.php",
                "../Tests/Form/*.php"
            ],
            tasks: [
                "shell:tests"
            ]
        },
        shell: {
            tests: {
                command: [
                    "cd ../../../..",
                    "phpunit app/Plugin/InfoTownLinkWp/Tests"
                ].join( "&&" )
            },
            phpdocs: {
                command: 'phpdoc -d "../" -t "docs"'
            },
            build: {
                command: [
                    "cd ..",
                    "tar zcf ./bin/build/infotownlinkwp.tar.gz --exclude ./bin ./*"
                ].join( "&&" )
            }
        }
    } );

    grunt.loadNpmTasks( "grunt-contrib-watch" );
    grunt.loadNpmTasks( "grunt-shell" );

    grunt.registerTask( "default", ["watch"] );
    grunt.registerTask( "tests", ["shell:tests"] );
    grunt.registerTask( "build", ["shell:build"] );
    grunt.registerTask( "docs", ["shell:phpdocs"] );
};