pipeline {
    agent any

    stages {

        stage('Build') {
            steps {
                sh 'docker build -t app_ci .'
            }
        }

        stage('Testes') {
            steps {
                sh '''
                docker network create ci_network || true

                docker rm -f postgres_test || true

                docker run -d \
                  --name postgres_test \
                  --network ci_network \
                  -e POSTGRES_DB=gcs_test \
                  -e POSTGRES_USER=postgres \
                  -e POSTGRES_PASSWORD=postgres \
                  postgres:15

                sleep 5

                docker run --rm \
                  --network ci_network \
                  --env-file .env.testing \
                  app_ci sh -c "
                    php artisan migrate &&
                    php artisan test
                  "

                docker stop postgres_test
                docker rm postgres_test
                '''
            }
        }

        stage('Deploy Homolog') {
            steps {
                sh '''
                cd docker

                docker rm -f postgres_homolog || true

                docker compose -f docker-compose.homolog.yml down
                docker compose -f docker-compose.homolog.yml up -d --build
                '''
            }
        }
    }
}