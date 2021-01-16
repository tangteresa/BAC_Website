# Buddy Adoption Center

The `Buddy Adoption Center (BAC)` for cats is a virtual adoption center built in 
the Sims 4 game. I imagined what the BAC would be like if it were a real 
business, and made a fun website for it! 

# Development Tools 

HTML, CSS, Javascript, PHP, mySQL, Apache server 

# Website Features 

- Responsive web design, with mobile menu view 
- Interactive contact form, with client-side and server-side form validation 
- Auto-refilling of contact form if user makes errors and needs to resubmit 
- Database of cat profiles 
- Adoptable cat list auto-updates with database changes 
- Interactive image gallery/slideshow 
- Animated cat profiles 

# Quick Website Tour
Here are screenshots of each page of the website for convenience! There is
also a **video tour** showing the interactive features, found in project file 
`COMING SOON` in the repo. 

`Homepage` 

`Cat profile page` 

`Events page` 

`Contact page` 

# Viewing Full Website 

Simply download the files and open index.html in your browser! However, the 
contact form will not be as interactive or submittable (and you won't be able 
to select cats to adopt) without a web server with PHP and a database. 

# Setup Interactive Website 

To experience the full range of features this website has, setup an
`Apache/mySQL/PHP` environment! 

Recommended: 
1. Download `XAMPP` (https://www.apachefriends.org/index.html)
2. In the XAMPP control panel, start both `Apache` and `mySQL` with the **Start** button
3. Now we will setup the cat profile database table in mySQL: 
   * Go to mySQL's admin page via the **Admin** button in the XAMPP control panel 
   * Under `User Accounts` on the admin page, make sure you are on the **root account** 
   * Click the `Databases` tab 
   * Under `Create database`, type `bac` for the database name and `utf8mb4_general_ci`
as the collation, then click `Create` 
   * Go to the `Import` tab at the top, and where it says to "choose a file to import", 
**import bac.sql** from this repo, then click `Go` at the bottom
   * You should now have a table called `cats` in the `bac database`! 

   * NOTE: this project assumes the cats table is hosted on a server called 
  `localhost`, under account with username `root` and no password. This should
  already be the case after following the instructions above! 

4. Save the website project files by navigating to folder `xampp`, then into 
folder `htdocs`, and extracting/saving them there 
5. In your browser, go to `localhost/folder_name/index.html` (where folder_name
is whatever folder the project files were extracted to inside htdocs) 
