FROM devenv-php:7.1

RUN composer global require "laravel/installer"

ENV PATH="${PATH}:/root/.composer/vendor/bin"

COPY bashrc /root/.bashrc

