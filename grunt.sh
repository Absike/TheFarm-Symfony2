#by @Hassan Absike

clear

while getopts "iprh" opt; do
  case $opt in
    i)
      tput setaf 7
      echo "Installing Grunt JS..."
      tput sgr0
      sudo npm install -g grunt-cli
      tput setaf 7
      echo "OK"
      tput sgr0
      ;;
    p)
      tput setaf 7
      echo "Installing Grunt js pluging..."
      tput sgr0
      sudo npm install grunt --save-dev
      sudo npm install grunt-bowercopy --save-dev
      sudo npm install grunt-contrib-clean --save-dev
      sudo npm install grunt-contrib-concat --save-dev
      sudo npm install grunt-contrib-copy --save-dev
      sudo npm install grunt-contrib-cssmin --save-dev
      sudo npm install grunt-contrib-uglify --save-de
      sudo npm install grunt-contrib-watch --save-dev
      tput setaf 7
      echo "OK"
      tput sgr0
      ;;
    h)
      tput setaf 2
      echo "Additional options:"
      echo "[-i] => [I]nstalling Grunt JS"
      echo "[-p] => [P]lugins install"
      echo "[-h] => [H]elp"
      echo "Default it running grunt [grunt]"
      tput sgr0
      ;;
    *)
      echo "Invalid option. See correct usage with [-h]."
      ;;
  esac
done


tput setaf 7
echo "Running grunt ..."
tput sgr0
sudo grunt
tput setaf 7
echo "OK"
tput sgr0