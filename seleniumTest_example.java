package in_class_activity_sept_7;

import java.util.*;

import static org.junit.jupiter.api.Assertions.*;
import org.junit.jupiter.api.AfterAll;
import org.junit.jupiter.api.AfterEach;
import org.junit.jupiter.api.BeforeAll;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;

import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.firefox.FirefoxDriver;     // for Firefox 
import org.openqa.selenium.chrome.ChromeDriver;       // for chrome


/**
 * Note: 
 *   Test environment: Firefox ??, selenium 3.141.59, Java ??, geckodriver ??
 *   https://github.com/mozilla/geckodriver/releases
 *   
 *   Test environment: Chrome ??, selenium 3.141.59, Java ??, ChromeDriver ??
 *   https://sites.google.com/a/chromium.org/chromedriver/downloads
 */

public class seleniumTest_example 
{	
   private WebDriver driver;
   private String url = "http://cs.virginia.edu/~jab7yp/aquarium/animals-events.php";

   @BeforeEach
   public void setUp() 
   {
// uncomment the following if you're using Firefox 
//      System.setProperty("webdriver.gecko.driver", "/path/to/your/gecko/driver");       // specify path to the driver
//      driver = new FirefoxDriver();    // open a web browser
      
// uncomment the following if you're using Chrome	   
      System.setProperty("webdriver.chrome.driver", "C:\\Users\\ryanl\\Desktop\\Selenium\\chromedriver_win32\\chromedriver.exe");   // specify path to the driver
      driver = new ChromeDriver();     // open a web browser
	   
      driver.get(url);                   // open the given url
   }

   @AfterEach
   public void teardown()
   {
      driver.quit();                     // close a web browser
   } 
   
   @Test
   public void test_login()
   {
	   driver.findElement(By.linkText("Dashboard")).click();
	   //Log in to the website
	   WebElement username = driver.findElement(By.xpath("//input[@name='username']"));
	   WebElement password = driver.findElement(By.xpath("//input[@name='password']"));
	   WebElement submitbutton = driver.findElement(By.xpath("//input[@type='submit']"));
	   username.sendKeys("frankfort");
	   password.sendKeys("BSLA7180!");
	   submitbutton.click();
	   //Test
	   WebElement logoutButton = driver.findElement(By.xpath("//a[@href='./logout.php']"));
	   String logout = logoutButton.getText();
	   assertEquals("Logout", logout);
   }
   
   @Test
   public void test_logout()
   {
	   driver.findElement(By.linkText("Dashboard")).click();
	   //Log in to the website
	   WebElement username = driver.findElement(By.xpath("//input[@name='username']"));
	   WebElement password = driver.findElement(By.xpath("//input[@name='password']"));
	   WebElement submitbutton = driver.findElement(By.xpath("//input[@type='submit']"));
	   username.sendKeys("frankfort");
	   password.sendKeys("BSLA7180!");
	   submitbutton.click();
	   //Test to see if logout appears
	   WebElement logoutButton = driver.findElement(By.xpath("//a[@href='./logout.php']"));
	   logoutButton.click();
	   WebElement header = driver.findElement(By.xpath("//h2"));
	   assertEquals("Login", header.getText());
   }
   
   @Test
   public void test_Australia()
   {
	   driver.findElement(By.linkText("Dashboard")).click();
	   //Log in to the website
	   WebElement username = driver.findElement(By.xpath("//input[@name='username']"));
	   WebElement password = driver.findElement(By.xpath("//input[@name='password']"));
	   WebElement submitbutton = driver.findElement(By.xpath("//input[@type='submit']"));
	   username.sendKeys("frankfort");
	   password.sendKeys("BSLA7180!");
	   submitbutton.click();
	   //Access Austrilia Exhibit
	   driver.findElement(By.xpath("/html/body/div/div/a[3]")).click();
   }
   
   @Test
   public void test_Australia_add_animal()
   {
	   driver.findElement(By.linkText("Dashboard")).click();
	   //Log in to the website
	   WebElement username = driver.findElement(By.xpath("//input[@name='username']"));
	   WebElement password = driver.findElement(By.xpath("//input[@name='password']"));
	   WebElement submitbutton = driver.findElement(By.xpath("//input[@type='submit']"));
	   username.sendKeys("frankfort");
	   password.sendKeys("BSLA7180!");
	   submitbutton.click();
	   driver.findElement(By.xpath("/html/body/div/div/a[3]")).click();
	   driver.findElement(By.xpath("//button[@class=\"btn btn-success\" and @type=\"button\"]")).click();
	   try {
		Thread.sleep(2000);
	} catch (InterruptedException e) {
		// TODO Auto-generated catch block
		e.printStackTrace();
	}
	   WebElement animalName = driver.findElement(By.xpath("//input[@id=\"animal_name\"]"));
	   WebElement animalType = driver.findElement(By.xpath("//input[@id=\"type\"]"));
	   WebElement animalPopulation = driver.findElement(By.xpath("//input[@id=\"population\"]"));
	   WebElement animalRegion = driver.findElement(By.xpath("//input[@id=\"region\"]"));
	   animalName.sendKeys("Wombat");
	   animalType.sendKeys("Mammal");
	   animalPopulation.sendKeys("2");
	   animalRegion.sendKeys("Savannah");
	   driver.findElement(By.xpath("//button[@type='submit' and text()='Add Animal']")).click();
	   String result = driver.findElement(By.xpath("/html/body/div/table/tbody/tr[3]/th")).getText();
	   driver.findElement(By.xpath("/html/body/div/table/tbody/tr[3]/td[4]/a")).click();
	   assertEquals("Wombat",result);
   }
   
   @Test
   public void test_Australia_change()
   {
	   driver.findElement(By.linkText("Dashboard")).click();
	   //Log in to the website
	   WebElement username = driver.findElement(By.xpath("//input[@name='username']"));
	   WebElement password = driver.findElement(By.xpath("//input[@name='password']"));
	   WebElement submitbutton = driver.findElement(By.xpath("//input[@type='submit']"));
	   username.sendKeys("frankfort");
	   password.sendKeys("BSLA7180!");
	   submitbutton.click();
	   driver.findElement(By.xpath("/html/body/div/div/a[3]")).click();
	   String original_population = driver.findElement(By.xpath("/html/body/div/table/tbody/tr[1]/td[2]")).getText();
	   driver.findElement(By.xpath("/html/body/div/table/tbody/tr[1]/td[2]/button")).click();
	   WebElement population = driver.findElement(By.xpath("//input[@id=\"population_for_pop\"]"));
	   try {
		Thread.sleep(1000);
	} catch (InterruptedException e) {
		// TODO Auto-generated catch block
		e.printStackTrace();
	}
	   population.sendKeys("17");
	   driver.findElement(By.xpath("//*[@id=\"adjust_pop\"]/div/div/div[2]/form/button")).click();
	   String new_population = driver.findElement(By.xpath("/html/body/div/table/tbody/tr[1]/td[2]")).getText();
	   driver.findElement(By.xpath("/html/body/div/table/tbody/tr[1]/td[2]/button")).click();
	   WebElement population2 = driver.findElement(By.xpath("//input[@id=\"population_for_pop\"]"));
	   try {
		Thread.sleep(1000);
	} catch (InterruptedException e) {
		// TODO Auto-generated catch block
		e.printStackTrace();
	}
	   population2.sendKeys("25");
	   driver.findElement(By.xpath("//*[@id=\"adjust_pop\"]/div/div/div[2]/form/button")).click();
	   assertNotEquals(new_population, original_population);
	   //get original value
	   //change value and pull it
	   //change value back
	   //check if values are not equal/equal
   }
   
   
   @Test
   public void test_Living_Seashore()
   {
	   driver.findElement(By.linkText("Dashboard")).click();
	   //Log in to the website
	   WebElement username = driver.findElement(By.xpath("//input[@name='username']"));
	   WebElement password = driver.findElement(By.xpath("//input[@name='password']"));
	   WebElement submitbutton = driver.findElement(By.xpath("//input[@type='submit']"));
	   username.sendKeys("frankfort");
	   password.sendKeys("BSLA7180!");
	   submitbutton.click();
	   driver.findElement(By.xpath("/html/body/div/div/a[7]")).click();
   }
   
   @Test
   public void test_Living_Seshore_add_animal()
   {
	   driver.findElement(By.linkText("Dashboard")).click();
	   //Log in to the website
	   WebElement username = driver.findElement(By.xpath("//input[@name='username']"));
	   WebElement password = driver.findElement(By.xpath("//input[@name='password']"));
	   WebElement submitbutton = driver.findElement(By.xpath("//input[@type='submit']"));
	   username.sendKeys("frankfort");
	   password.sendKeys("BSLA7180!");
	   submitbutton.click();
	   driver.findElement(By.xpath("/html/body/div/div/a[7]")).click();
	   driver.findElement(By.xpath("//button[@class=\"btn btn-success\" and @type=\"button\"]")).click();
	   try {
		Thread.sleep(2000);
	} catch (InterruptedException e) {
		// TODO Auto-generated catch block
		e.printStackTrace();
	}  
	   WebElement animalName = driver.findElement(By.xpath("//input[@id=\"animal_name\"]"));
	   WebElement animalType = driver.findElement(By.xpath("//input[@id=\"type\"]"));
	   WebElement animalPopulation = driver.findElement(By.xpath("//input[@id=\"population\"]"));
	   WebElement animalRegion = driver.findElement(By.xpath("//input[@id=\"region\"]"));
	   animalName.sendKeys("test");
	   animalType.sendKeys("test");
	   animalPopulation.sendKeys("2");
	   animalRegion.sendKeys("test");
	   driver.findElement(By.xpath("//button[@type='submit' and text()='Add Animal']")).click();
	   String result = driver.findElement(By.xpath("/html/body/div/table/tbody/tr[3]/th")).getText();
	   driver.findElement(By.xpath("/html/body/div/table/tbody/tr[3]/td[4]/a")).click();
	   assertEquals("test",result);
   }
   
   @Test
   public void test_LivingSeashore_change()
   {
	   driver.findElement(By.linkText("Dashboard")).click();
	   //Log in to the website
	   WebElement username = driver.findElement(By.xpath("//input[@name='username']"));
	   WebElement password = driver.findElement(By.xpath("//input[@name='password']"));
	   WebElement submitbutton = driver.findElement(By.xpath("//input[@type='submit']"));
	   username.sendKeys("frankfort");
	   password.sendKeys("BSLA7180!");
	   submitbutton.click();
	   driver.findElement(By.xpath("/html/body/div/div/a[7]")).click();
	   String original_population = driver.findElement(By.xpath("/html/body/div/table/tbody/tr[1]/td[2]")).getText();
	   driver.findElement(By.xpath("/html/body/div/table/tbody/tr[1]/td[2]/button")).click();
	   WebElement population = driver.findElement(By.xpath("//input[@id=\"population_for_pop\"]"));
	   try {
		Thread.sleep(1000);
	} catch (InterruptedException e) {
		// TODO Auto-generated catch block
		e.printStackTrace();
	}
	   population.sendKeys("12");
	   driver.findElement(By.xpath("//*[@id=\"adjust_pop\"]/div/div/div[2]/form/button")).click();
	   String new_population = driver.findElement(By.xpath("/html/body/div/table/tbody/tr[1]/td[2]")).getText();
	   driver.findElement(By.xpath("/html/body/div/table/tbody/tr[1]/td[2]/button")).click();
	   WebElement population2 = driver.findElement(By.xpath("//input[@id=\"population_for_pop\"]"));
	   try {
		Thread.sleep(1000);
	} catch (InterruptedException e) {
		// TODO Auto-generated catch block
		e.printStackTrace();
	}
	   population2.sendKeys("5");
	   driver.findElement(By.xpath("//*[@id=\"adjust_pop\"]/div/div/div[2]/form/button")).click();
	   assertNotEquals(new_population, original_population);
	   //get original value
	   //change value and pull it
	   //change value back
	   //check if values are not equal/equal
   }
   
   @Test
   public void test_Surviving()
   {
	   driver.findElement(By.linkText("Dashboard")).click();
	   //Log in to the website
	   WebElement username = driver.findElement(By.xpath("//input[@name='username']"));
	   WebElement password = driver.findElement(By.xpath("//input[@name='password']"));
	   WebElement submitbutton = driver.findElement(By.xpath("//input[@type='submit']"));
	   username.sendKeys("frankfort");
	   password.sendKeys("BSLA7180!");
	   submitbutton.click();
	   driver.findElement(By.xpath("/html/body/div/div/a[11]")).click();
	   
   }
   
   @Test
   public void test_Surviving_add_animal()
   {
	   driver.findElement(By.linkText("Dashboard")).click();
	   //Log in to the website
	   WebElement username = driver.findElement(By.xpath("//input[@name='username']"));
	   WebElement password = driver.findElement(By.xpath("//input[@name='password']"));
	   WebElement submitbutton = driver.findElement(By.xpath("//input[@type='submit']"));
	   username.sendKeys("frankfort");
	   password.sendKeys("BSLA7180!");
	   submitbutton.click();
	   driver.findElement(By.xpath("/html/body/div/div/a[11]")).click();
	   driver.findElement(By.xpath("//button[@class=\"btn btn-success\" and @type=\"button\"]")).click();
	   try {
		Thread.sleep(2000);
	} catch (InterruptedException e) {
		// TODO Auto-generated catch block
		e.printStackTrace();
	}  
	   WebElement animalName = driver.findElement(By.xpath("//input[@id=\"animal_name\"]"));
	   WebElement animalType = driver.findElement(By.xpath("//input[@id=\"type\"]"));
	   WebElement animalPopulation = driver.findElement(By.xpath("//input[@id=\"population\"]"));
	   WebElement animalRegion = driver.findElement(By.xpath("//input[@id=\"region\"]"));
	   animalName.sendKeys("test");
	   animalType.sendKeys("test");
	   animalPopulation.sendKeys("2");
	   animalRegion.sendKeys("test");
	   driver.findElement(By.xpath("//button[@type='submit' and text()='Add Animal']")).click();
	   String result = driver.findElement(By.xpath("/html/body/div/table/tbody/tr[3]/th")).getText();
	   driver.findElement(By.xpath("/html/body/div/table/tbody/tr[3]/td[4]/a")).click();
	   assertEquals("test",result);
   }
   
   @Test
   public void test_Surviving_change()
   {
	   driver.findElement(By.linkText("Dashboard")).click();
	   //Log in to the website
	   WebElement username = driver.findElement(By.xpath("//input[@name='username']"));
	   WebElement password = driver.findElement(By.xpath("//input[@name='password']"));
	   WebElement submitbutton = driver.findElement(By.xpath("//input[@type='submit']"));
	   username.sendKeys("frankfort");
	   password.sendKeys("BSLA7180!");
	   submitbutton.click();
	   driver.findElement(By.xpath("/html/body/div/div/a[11]")).click();
	   String original_population = driver.findElement(By.xpath("/html/body/div/table/tbody/tr[1]/td[2]")).getText();
	   driver.findElement(By.xpath("/html/body/div/table/tbody/tr[1]/td[2]/button")).click();
	   WebElement population = driver.findElement(By.xpath("//input[@id=\"population_for_pop\"]"));
	   try {
		Thread.sleep(1000);
	} catch (InterruptedException e) {
		// TODO Auto-generated catch block
		e.printStackTrace();
	}
	   population.sendKeys("82");
	   driver.findElement(By.xpath("//*[@id=\"adjust_pop\"]/div/div/div[2]/form/button")).click();
	   String new_population = driver.findElement(By.xpath("/html/body/div/table/tbody/tr[1]/td[2]")).getText();
	   driver.findElement(By.xpath("/html/body/div/table/tbody/tr[1]/td[2]/button")).click();
	   WebElement population2 = driver.findElement(By.xpath("//input[@id=\"population_for_pop\"]"));
	   try {
		Thread.sleep(1000);
	} catch (InterruptedException e) {
		// TODO Auto-generated catch block
		e.printStackTrace();
	}
	   population2.sendKeys("6");
	   driver.findElement(By.xpath("//*[@id=\"adjust_pop\"]/div/div/div[2]/form/button")).click();
	   assertNotEquals(new_population, original_population);
	   //get original value
	   //change value and pull it
	   //change value back
	   //check if values are not equal/equal
   }
   
   @Test
   public void test_Blacktip()
   {
	   driver.findElement(By.linkText("Dashboard")).click();
	   //Log in to the website
	   WebElement username = driver.findElement(By.xpath("//input[@name='username']"));
	   WebElement password = driver.findElement(By.xpath("//input[@name='password']"));
	   WebElement submitbutton = driver.findElement(By.xpath("//input[@type='submit']"));
	   username.sendKeys("frankfort");
	   password.sendKeys("BSLA7180!");
	   submitbutton.click();
	   driver.findElement(By.xpath("/html/body/div/div/a[4]")).click();
   }
   
   @Test
   public void test_BlackTip_add_animal()
   {
	   driver.findElement(By.linkText("Dashboard")).click();
	   //Log in to the website
	   WebElement username = driver.findElement(By.xpath("//input[@name='username']"));
	   WebElement password = driver.findElement(By.xpath("//input[@name='password']"));
	   WebElement submitbutton = driver.findElement(By.xpath("//input[@type='submit']"));
	   username.sendKeys("frankfort");
	   password.sendKeys("BSLA7180!");
	   submitbutton.click();
	   driver.findElement(By.xpath("/html/body/div/div/a[4]")).click();
	   driver.findElement(By.xpath("//button[@class=\"btn btn-success\" and @type=\"button\"]")).click();
	   try {
		Thread.sleep(2000);
	} catch (InterruptedException e) {
		// TODO Auto-generated catch block
		e.printStackTrace();
	}  
	   WebElement animalName = driver.findElement(By.xpath("//input[@id=\"animal_name\"]"));
	   WebElement animalType = driver.findElement(By.xpath("//input[@id=\"type\"]"));
	   WebElement animalPopulation = driver.findElement(By.xpath("//input[@id=\"population\"]"));
	   WebElement animalRegion = driver.findElement(By.xpath("//input[@id=\"region\"]"));
	   animalName.sendKeys("test");
	   animalType.sendKeys("test");
	   animalPopulation.sendKeys("2");
	   animalRegion.sendKeys("test");
	   driver.findElement(By.xpath("//button[@type='submit' and text()='Add Animal']")).click();
	   String result = driver.findElement(By.xpath("/html/body/div/table/tbody/tr[3]/th")).getText();
	   driver.findElement(By.xpath("/html/body/div/table/tbody/tr[3]/td[4]/a")).click();
	   assertEquals("test",result);
   }
   
   @Test
   public void test_BlackTip_change()
   {
	   driver.findElement(By.linkText("Dashboard")).click();
	   //Log in to the website
	   WebElement username = driver.findElement(By.xpath("//input[@name='username']"));
	   WebElement password = driver.findElement(By.xpath("//input[@name='password']"));
	   WebElement submitbutton = driver.findElement(By.xpath("//input[@type='submit']"));
	   username.sendKeys("frankfort");
	   password.sendKeys("BSLA7180!");
	   submitbutton.click();
	   driver.findElement(By.xpath("/html/body/div/div/a[4]")).click();
	   String original_population = driver.findElement(By.xpath("/html/body/div/table/tbody/tr[1]/td[2]")).getText();
	   driver.findElement(By.xpath("/html/body/div/table/tbody/tr[1]/td[2]/button")).click();
	   WebElement population = driver.findElement(By.xpath("//input[@id=\"population_for_pop\"]"));
	   try {
		Thread.sleep(1000);
	} catch (InterruptedException e) {
		// TODO Auto-generated catch block
		e.printStackTrace();
	}
	   population.sendKeys("8");
	   driver.findElement(By.xpath("//*[@id=\"adjust_pop\"]/div/div/div[2]/form/button")).click();
	   String new_population = driver.findElement(By.xpath("/html/body/div/table/tbody/tr[1]/td[2]")).getText();
	   driver.findElement(By.xpath("/html/body/div/table/tbody/tr[1]/td[2]/button")).click();
	   WebElement population2 = driver.findElement(By.xpath("//input[@id=\"population_for_pop\"]"));
	   try {
		Thread.sleep(1000);
	} catch (InterruptedException e) {
		// TODO Auto-generated catch block
		e.printStackTrace();
	}
	   population2.sendKeys("3");
	   driver.findElement(By.xpath("//*[@id=\"adjust_pop\"]/div/div/div[2]/form/button")).click();
	   assertNotEquals(new_population, original_population);
	   //get original value
	   //change value and pull it
	   //change value back
	   //check if values are not equal/equal
   }
   
   @Test
   public void test_Maryland()
   {
	   driver.findElement(By.linkText("Dashboard")).click();
	   //Log in to the website
	   WebElement username = driver.findElement(By.xpath("//input[@name='username']"));
	   WebElement password = driver.findElement(By.xpath("//input[@name='password']"));
	   WebElement submitbutton = driver.findElement(By.xpath("//input[@type='submit']"));
	   username.sendKeys("frankfort");
	   password.sendKeys("BSLA7180!");
	   submitbutton.click();
	   driver.findElement(By.xpath("/html/body/div/div/a[8]")).click();
   }
   
   @Test
   public void test_Maryland_add_animal()
   {
	   driver.findElement(By.linkText("Dashboard")).click();
	   //Log in to the website
	   WebElement username = driver.findElement(By.xpath("//input[@name='username']"));
	   WebElement password = driver.findElement(By.xpath("//input[@name='password']"));
	   WebElement submitbutton = driver.findElement(By.xpath("//input[@type='submit']"));
	   username.sendKeys("frankfort");
	   password.sendKeys("BSLA7180!");
	   submitbutton.click();
	   driver.findElement(By.xpath("/html/body/div/div/a[8]")).click();
	   driver.findElement(By.xpath("//button[@class=\"btn btn-success\" and @type=\"button\"]")).click();
	   try {
		Thread.sleep(2000);
	} catch (InterruptedException e) {
		// TODO Auto-generated catch block
		e.printStackTrace();
	}  
	   WebElement animalName = driver.findElement(By.xpath("//input[@id=\"animal_name\"]"));
	   WebElement animalType = driver.findElement(By.xpath("//input[@id=\"type\"]"));
	   WebElement animalPopulation = driver.findElement(By.xpath("//input[@id=\"population\"]"));
	   WebElement animalRegion = driver.findElement(By.xpath("//input[@id=\"region\"]"));
	   animalName.sendKeys("test");
	   animalType.sendKeys("test");
	   animalPopulation.sendKeys("2");
	   animalRegion.sendKeys("test");
	   driver.findElement(By.xpath("//button[@type='submit' and text()='Add Animal']")).click();
	   String result = driver.findElement(By.xpath("/html/body/div/table/tbody/tr[3]/th")).getText();
	   driver.findElement(By.xpath("/html/body/div/table/tbody/tr[3]/td[4]/a")).click();
	   assertEquals("test",result);
   }
   
   @Test
   public void test_Maryland_change()
   {
	   driver.findElement(By.linkText("Dashboard")).click();
	   //Log in to the website
	   WebElement username = driver.findElement(By.xpath("//input[@name='username']"));
	   WebElement password = driver.findElement(By.xpath("//input[@name='password']"));
	   WebElement submitbutton = driver.findElement(By.xpath("//input[@type='submit']"));
	   username.sendKeys("frankfort");
	   password.sendKeys("BSLA7180!");
	   submitbutton.click();
	   driver.findElement(By.xpath("/html/body/div/div/a[8]")).click();
	   String original_population = driver.findElement(By.xpath("/html/body/div/table/tbody/tr[1]/td[2]")).getText();
	   driver.findElement(By.xpath("/html/body/div/table/tbody/tr[1]/td[2]/button")).click();
	   WebElement population = driver.findElement(By.xpath("//input[@id=\"population_for_pop\"]"));
	   try {
		Thread.sleep(1000);
	} catch (InterruptedException e) {
		// TODO Auto-generated catch block
		e.printStackTrace();
	}
	   population.sendKeys("200");
	   driver.findElement(By.xpath("//*[@id=\"adjust_pop\"]/div/div/div[2]/form/button")).click();
	   String new_population = driver.findElement(By.xpath("/html/body/div/table/tbody/tr[1]/td[2]")).getText();
	   driver.findElement(By.xpath("/html/body/div/table/tbody/tr[1]/td[2]/button")).click();
	   WebElement population2 = driver.findElement(By.xpath("//input[@id=\"population_for_pop\"]"));
	   try {
		Thread.sleep(1000);
	} catch (InterruptedException e) {
		// TODO Auto-generated catch block
		e.printStackTrace();
	}
	   population2.sendKeys("57");
	   driver.findElement(By.xpath("//*[@id=\"adjust_pop\"]/div/div/div[2]/form/button")).click();
	   assertNotEquals(new_population, original_population);
	   //get original value
	   //change value and pull it
	   //change value back
	   //check if values are not equal/equal
   }
   
   @Test
   public void test_Upland()
   {
	   driver.findElement(By.linkText("Dashboard")).click();
	   //Log in to the website
	   WebElement username = driver.findElement(By.xpath("//input[@name='username']"));
	   WebElement password = driver.findElement(By.xpath("//input[@name='password']"));
	   WebElement submitbutton = driver.findElement(By.xpath("//input[@type='submit']"));
	   username.sendKeys("frankfort");
	   password.sendKeys("BSLA7180!");
	   submitbutton.click();
	   driver.findElement(By.xpath("/html/body/div/div/a[12]")).click();
   }
   
   @Test
   public void test_Upland_add_animal()
   {
	   driver.findElement(By.linkText("Dashboard")).click();
	   //Log in to the website
	   WebElement username = driver.findElement(By.xpath("//input[@name='username']"));
	   WebElement password = driver.findElement(By.xpath("//input[@name='password']"));
	   WebElement submitbutton = driver.findElement(By.xpath("//input[@type='submit']"));
	   username.sendKeys("frankfort");
	   password.sendKeys("BSLA7180!");
	   submitbutton.click();
	   driver.findElement(By.xpath("/html/body/div/div/a[12]")).click();
	   driver.findElement(By.xpath("//button[@class=\"btn btn-success\" and @type=\"button\"]")).click();
	   try {
		Thread.sleep(2000);
	} catch (InterruptedException e) {
		// TODO Auto-generated catch block
		e.printStackTrace();
	}  
	   WebElement animalName = driver.findElement(By.xpath("//input[@id=\"animal_name\"]"));
	   WebElement animalType = driver.findElement(By.xpath("//input[@id=\"type\"]"));
	   WebElement animalPopulation = driver.findElement(By.xpath("//input[@id=\"population\"]"));
	   WebElement animalRegion = driver.findElement(By.xpath("//input[@id=\"region\"]"));
	   animalName.sendKeys("test");
	   animalType.sendKeys("test");
	   animalPopulation.sendKeys("2");
	   animalRegion.sendKeys("test");
	   driver.findElement(By.xpath("//button[@type='submit' and text()='Add Animal']")).click();
	   String result = driver.findElement(By.xpath("/html/body/div/table/tbody/tr[3]/th")).getText();
	   driver.findElement(By.xpath("/html/body/div/table/tbody/tr[3]/td[4]/a")).click();
	   assertEquals("test",result);
   }
   
   @Test
   public void test_Upland_change()
   {
	   driver.findElement(By.linkText("Dashboard")).click();
	   //Log in to the website
	   WebElement username = driver.findElement(By.xpath("//input[@name='username']"));
	   WebElement password = driver.findElement(By.xpath("//input[@name='password']"));
	   WebElement submitbutton = driver.findElement(By.xpath("//input[@type='submit']"));
	   username.sendKeys("frankfort");
	   password.sendKeys("BSLA7180!");
	   submitbutton.click();
	   driver.findElement(By.xpath("/html/body/div/div/a[12]")).click();
	   String original_population = driver.findElement(By.xpath("/html/body/div/table/tbody/tr[1]/td[2]")).getText();
	   driver.findElement(By.xpath("/html/body/div/table/tbody/tr[1]/td[2]/button")).click();
	   WebElement population = driver.findElement(By.xpath("//input[@id=\"population_for_pop\"]"));
	   try {
		Thread.sleep(1000);
	} catch (InterruptedException e) {
		// TODO Auto-generated catch block
		e.printStackTrace();
	}
	   population.sendKeys("11");
	   driver.findElement(By.xpath("//*[@id=\"adjust_pop\"]/div/div/div[2]/form/button")).click();
	   String new_population = driver.findElement(By.xpath("/html/body/div/table/tbody/tr[1]/td[2]")).getText();
	   driver.findElement(By.xpath("/html/body/div/table/tbody/tr[1]/td[2]/button")).click();
	   WebElement population2 = driver.findElement(By.xpath("//input[@id=\"population_for_pop\"]"));
	   try {
		Thread.sleep(1000);
	} catch (InterruptedException e) {
		// TODO Auto-generated catch block
		e.printStackTrace();
	}
	   population2.sendKeys("13");
	   driver.findElement(By.xpath("//*[@id=\"adjust_pop\"]/div/div/div[2]/form/button")).click();
	   assertNotEquals(new_population, original_population);
	   //get original value
	   //change value and pull it
	   //change value back
	   //check if values are not equal/equal
   }
 
 
   
 
}
