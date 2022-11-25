FROM nanoninja/php-fpm

MAINTAINER Sergey Kozlov "hello@sergeykozlov.ru"

# Arguments defined in docker-compose.yml
ARG user
ARG uid


ARG ssh_prv_key
ARG ssh_pub_key

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    openssh-client

##########################################################################

# Add the SSH public keys of the Git server to the known hosts (here, github.com)
#RUN mkdir -p -m 0700 ~/.ssh && ssh-keyscan gitlab.com >> ~/.ssh/known_hosts

######
RUN echo "###################################"
RUN echo "${SSH_PRIVATE_KEY}"
RUN echo "###################################"
##Pass the content of the private key into the container
#RUN mkdir ~/.ssh/
#RUN echo "${SSH_PRIVATE_KEY}" > ~/.ssh/id_rsa \
#    && cat ~/.ssh/id_rsa #Github requires a private key with strict permission settings


#RUN chmod 600 ~/.ssh/id_rsa #Add Github to known hosts
#RUN touch ~/.ssh/known_hosts
#RUN ssh-keyscan gitlab.com >> ~/.ssh/known_hosts

#RUN  echo "    IdentityFile ~/.ssh/id_rsa" >> /etc/ssh/ssh_config

#####

# Authorize SSH Host
RUN mkdir -p ~/.ssh \
    && touch ~/.ssh/known_hosts \
    && ssh-keyscan gitlab.com > ~/.ssh/known_hosts

# Add the keys and set permissions
RUN echo "$ssh_prv_key" > ~/.ssh/id_rsa \
    && echo "$ssh_pub_key" > ~/.ssh/id_rsa.pub \
    && chmod 600 ~/.ssh/id_rsa \
    && chmod 600 ~/.ssh/id_rsa.pub

#####

##############################

# Clone the repository, notice the "--mount=type=ssh" option, which allow this instruction to use SSH forwarding
#RUN --mount=type=ssh git clone --depth=1 'git@gitlab.com:SergeyKozlov/nad.git'
# Clone the conf files into the docker container
RUN cd /var/www/html \        
   && git clone git@gitlab.com:SergeyKozlov/nad.git

#########################################################################

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Get latest Composer
#COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
#RUN chown -R $USER /home/$user/ /home/$user/

#RUN useradd -G www-data,root -u $uid -d /home/$user $user
#RUN mkdir -p /home/$user/.composer && \
#    chown -R $user:$user /home/$user

# Set working directory
#WORKDIR /var/www

#USER $user


# Remove SSH keys
###RUN rm -rf ~/.ssh/

# Add the rest of the files
ADD . .


