package app.hack.angel.angelhack;

import android.content.Context;
import android.location.Criteria;
import android.location.Location;
import android.location.LocationManager;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.Toast;


public class MainActivity2Activity extends ActionBarActivity {

    private String provider;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main_activity2);

        LocationManager lm = (LocationManager) getSystemService(Context.LOCATION_SERVICE);
        Criteria ct = new Criteria();
        provider = lm.getBestProvider(ct, false);
        final Location location = lm.getLastKnownLocation(provider);
        //wait(2000);
        if (location != null) {
            Toast.makeText(getBaseContext(), "location valid", Toast.LENGTH_SHORT).show();
        }
        else    {
            Toast.makeText(getBaseContext(), "location invalid", Toast.LENGTH_SHORT).show();
        }

    }
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_main_activity2, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }
}
