pipeline {
    agent any

    stages {

        stage('Build') {
            steps {
                sh 'echo "Build OK"'
            }
        }

        stage('Testes') {
            steps {
                sh '''
                echo "🔨 Build da imagem de testes..."
                docker build -t app_ci .

                echo "🌐 Criando rede..."
                docker network create ci_network || true

                echo "🗑 Limpando container antigo..."
                docker rm -f postgres_test || true

                echo "🐘 Subindo Postgres de teste..."
                docker run -d --name postgres_test \
                    --network ci_network \
                    -e POSTGRES_DB=gcs_test \
                    -e POSTGRES_USER=postgres \
                    -e POSTGRES_PASSWORD=postgres \
                    postgres:15

                echo "⏳ Aguardando banco..."
                sleep 5

                echo "🧪 Rodando testes..."
                docker run --rm \
                    --network ci_network \
                    --env-file .env.testing \
                    app_ci sh -c "
                        php artisan migrate &&
                        php artisan test
                    "

                echo "🧹 Limpando ambiente de teste..."
                docker stop postgres_test
                docker rm postgres_test
                '''
            }
        }

        stage('Deploy Homolog') {
            steps {
                sh '''
                echo "🚀 Atualizando homolog..."

                cd docker

                docker compose -f docker-compose.homolog.yml down || true
                docker compose -f docker-compose.homolog.yml up -d --build
                '''
            }
        }
    }
}