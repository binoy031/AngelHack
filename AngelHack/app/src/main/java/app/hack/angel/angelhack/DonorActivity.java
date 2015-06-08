package app.hack.angel.angelhack;

import android.content.Context;
import android.content.Intent;
import android.location.Criteria;
import android.location.Location;
import android.location.LocationManager;
import android.os.Handler;
import android.support.v7.app.ActionBarActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.Toast;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;

import java.util.ArrayList;


public class DonorActivity extends ActionBarActivity {

    EditText name,phno,qty;
    ImageView img1;
    String sname,sphno,sqty,response;
    private LocationManager lm;
    private String provider;
    double lat=0.0;
    double lng=0.0;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_donor);

        name=(EditText) findViewById(R.id.editText);
        phno=(EditText)findViewById(R.id.editText2);
        qty=(EditText)findViewById(R.id.editText3);
        img1=(ImageView)findViewById(R.id.imageView3);

       try {

            //Get location Manager
           lm = (LocationManager) getSystemService(Context.LOCATION_SERVICE);
            Criteria ct = new Criteria();
            provider = lm.getBestProvider(ct, false);
            final Location location = lm.getLastKnownLocation(provider);
            //wait(2000);
           if(location!=null) {


               final Handler handler = new Handler();
               handler.post(new Runnable() {
                   @Override
                   public void run() {


                       double lat = (double) (location.getLatitude());
                       double lng = (double) (location.getLongitude());
                       Log.v("lat,lng-print", "lat" + lat + "lng" + lng);
                       Toast.makeText(getBaseContext(), "donor:" + lat + "fdf" + lng, Toast.LENGTH_LONG).show();


                   }
               });

           }
           else {
               Toast.makeText(getBaseContext(), "location null", Toast.LENGTH_SHORT).show();
           }



      }
        catch (Exception e) {
           e.printStackTrace();
        }

        img1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {


                   sname = name.getText().toString();
                    sphno = phno.getText().toString();
                    sqty = qty.getText().toString();
                    final String latitude = "10.054494228319623";
                    final String longitude = "76.3513970375061";

                new Thread(new Runnable() {
                    @Override
                    public void run() {
                        ArrayList<NameValuePair> parms = new ArrayList<NameValuePair>();
                        parms.add(new BasicNameValuePair("name", sname));
                        parms.add(new BasicNameValuePair("mobno", sphno));
                        parms.add(new BasicNameValuePair("amount", sqty));
                        parms.add(new BasicNameValuePair("latitude", latitude));
                        parms.add(new BasicNameValuePair("longitude", longitude));
                        parms.add(new BasicNameValuePair("status", "give"));
                        try {
                            Thread.sleep(5000);
                            response = SimpleHttpClient.executeHttpPost("http://172.16.10.109/angelhack/testfinal.php", parms);
                        } catch (Exception e) {
                            e.printStackTrace();
                        }
                    }
                }).start();
                try {
                    Thread.sleep(2000);
                    Toast.makeText(getBaseContext(), "donor"+response, Toast.LENGTH_SHORT).show();
                }catch(Exception e)
                {
                    e.printStackTrace();
                }

                Intent intent=new Intent(getBaseContext(),AcceptList.class);
                startActivity(intent);

                //}
                // }
            }}
            );



}


        @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_donor, menu);
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
