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
//      System.setProperty("webdriver.chrome.driver", "/path/to/your/chrome/driver");   // specify path to the driver
//      driver = new ChromeDriver();     // open a web browser
	   
      driver.get(url);                   // open the given url
   }

   @AfterEach
   public void teardown()
   {
      driver.quit();                     // close a web browser
   } 

   @Test
   public void test_openURL()
   {
      assertEquals(driver.getTitle(), "Aquarium");	// check if we are on the right page
   }
 
   
 
}
