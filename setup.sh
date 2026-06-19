#!/bin/bash

VM_USER="univates"
VM_IP="177.44.248.101"

echo "🚀 Subindo estrutura completa na VM..."

ssh $VM_USER@$VM_IP << 'EOF'

echo "📦 Instalando dependências..."
sudo apt update -y
sudo apt install -y docker.io git curl

echo "🔌 Ativando Docker..."
sudo systemctl enable docker
sudo systemctl start docker

echo "🔧 Instalando Docker Compose..."
DOCKER_CONFIG=${DOCKER_CONFIG:-/usr/libexec/docker}
sudo mkdir -p $DOCKER_CONFIG/cli-plugins

sudo curl -SL https://github.com/docker/compose/releases/download/v2.27.0/docker-compose-linux-x86_64 \
  -o $DOCKER_CONFIG/cli-plugins/docker-compose

sudo chmod +x $DOCKER_CONFIG/cli-plugins/docker-compose

echo "📁 Clonando projeto..."
rm -rf gcs2026
git clone https://github.com/GabrieLlussi/gcs2026.git

cd gcs2026/docker

echo "🐳 Subindo HOMOLOG..."
sudo docker compose -f docker-compose.homolog.yml up -d --build

echo "🐳 Subindo PROD..."
sudo docker compose -f docker-compose.prod.yml up -d --build

cd ..

echo "🧠 Subindo Jenkins..."

sudo docker run -d \
  --name jenkins \
  -p 8080:8080 -p 50000:50000 \
  -v jenkins_home:/var/jenkins_home \
  -v /var/run/docker.sock:/var/run/docker.sock \
  -v /usr/bin/docker:/usr/bin/docker \
  -v /usr/libexec/docker:/usr/libexec/docker \
  -e JAVA_OPTS="-Djenkins.install.runSetupWizard=false" \
  jenkins/jenkins:lts

echo "⏳ Aguardando Jenkins..."
sleep 30

echo "🔌 Instalando plugins..."
sudo docker exec jenkins jenkins-plugin-cli --plugins git workflow-aggregator

echo "👤 Criando usuário + job automático..."

sudo docker exec jenkins bash -c '
mkdir -p /var/jenkins_home/init.groovy.d

cat <<EOT > /var/jenkins_home/init.groovy.d/setup.groovy
import jenkins.model.*
import hudson.security.*
import org.jenkinsci.plugins.workflow.job.*
import org.jenkinsci.plugins.workflow.cps.*

def instance = Jenkins.getInstance()

// USER
def realm = new HudsonPrivateSecurityRealm(false)
realm.createAccount("admin", "admin")
instance.setSecurityRealm(realm)

def strategy = new FullControlOnceLoggedInAuthorizationStrategy()
strategy.setAllowAnonymousRead(false)
instance.setAuthorizationStrategy(strategy)

// JOB
def jobName = "pipeline-gcs"

if (instance.getItem(jobName) == null) {
    def job = instance.createProject(WorkflowJob, jobName)

    job.setDefinition(new CpsScmFlowDefinition(
        new hudson.plugins.git.GitSCM("https://github.com/GabrieLlussi/gcs2026.git"),
        "Jenkinsfile"
    ))

    job.save()
}

instance.save()
EOT
'

sudo docker restart jenkins

echo "✅ TUDO PRONTO!"

EOF