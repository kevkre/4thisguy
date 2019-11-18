pipeline {
    agent any

    stages {
        stage("Create FTP Client Docker") {
            steps {
                sh 'docker build -t lftp .'
            }
        }
       stage("Deploy") {
           steps {
                withCredentials([usernamePassword(credentialsId:"ftp-flycinema", usernameVariable: "username", passwordVariable: "password")]) {
                    sh "docker run --rm -w /opt -v `pwd`:/opt --name lftp-flycinema lftp:latest /bin/sh -c 'lftp -u \"${username}\",\"${password}\" -e \"set ssl:verify-certificate false; mirror -R /opt/ /; bye\" ftp://ftp.euzy.de'"
               }
          }
       }
    }
}

