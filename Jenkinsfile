pipeline {
    agent any

    stages {

        stage('Checkout') {
            steps {
                git branch: 'main', url: 'https://github.com/GabrieLlussi/gcs2026.git'
            }
        }

        stage('Build') {
            steps {
                sh 'echo "Build OK"'
            }
        }

        stage('Testes') {
            steps {
                sh '''
                docker network create ci_network || true

                docker rm -f postgres_test || true

                docker run -d --name postgres_test \
                    --network ci_network \
                    -e POSTGRES_DB=gcs_test \
                    -e POSTGRES_USER=postgres \
                    -e POSTGRES_PASSWORD=postgres \
                    postgres:15

                sleep 5

                docker build -t app_ci --build-arg APP_ENV=testing .

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

        stage('Qualidade de Código (PHPMD)') {
            steps {
                sh '''
                docker build -t app_ci .

                docker run --rm app_ci sh -c "
                vendor/bin/phpmd app text unusedcode
                "
                '''
            }
        }

        stage('Deploy Homolog') {
            steps {
                sh '''
                cd docker
                docker compose -f docker-compose.homolog.yml down || true
                docker compose -f docker-compose.homolog.yml up -d --build
                '''
            }
        }
    }
}